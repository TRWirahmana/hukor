<?php
class DikbudController extends BaseController {

    protected $layout = 'layouts.admin';

    public function index()
    {
        $DAL = new DAL_Dikbud();
        $data = $DAL->GetAllLink();

        if(count($data->toArray()) != 0)
        {
            $this->layout->content = View::make('dikbud.index', array(
                'title' => 'Pengaturan Link',
                'detail' => '',
                'form_opts' => array(
                    'route' => array('admin.linked.update', '1'),
                    'enctype' => 'multipart/form-data',
                    'method' => 'put',
                    'class' => 'form-horizontal',
                    'id' => 'form_linked'
                ),
                'data' => $data->toArray()
            ));
        }
        else
        {
            $this->layout->content = View::make('dikbud.index', array(
                'title' => 'Pengaturan Link',
                'detail' => '',
                'form_opts' => array(
                    'action' => 'DikbudController@save',
                    'enctype' => 'multipart/form-data',
                    'method' => 'post',
                    'class' => 'form-horizontal',
                    'id' => 'form_linked'
                )
            ));
        }
    }

    public function save()
    {
        $input = Input::all();
        $DAL = new DAL_Dikbud();
        $helper = new HukorHelper();

        for($x = 0; $x < count($input['link']) ; $x++)
        {
            $uploadSuccess = $helper->UploadFile('link', $input['gambar'][$x]);

            if($uploadSuccess)
            {
                $DAL->InsertToTable($input['link'][$x], $input['gambar'][$x]);
            }
            else
            {
                return Redirect::route('linked')->with('error', 'Data Gagal Disimpan.');
            }
        }

        return Redirect::to('admin/linked')->with('success', 'Data Berhasil Di Simpan.');
    }

    /**
     * jika id yang di dalam database tidak terdapat di dalam array input id, maka gambar di hapus.
     * setelah pengahpusan gambar, truncate table.
     * jika table sudah kosong, insert ulang dengan kondisi:
     *      - jika inputan gambar dari form tidak terisi, maka ambil gambar dari data yang di get sebelumnya.
     *      - dan jika gambar dari form terisi, maka insert baru dan upload gambar baru.
     */
    public function update($id)
    {
        $input = Input::all();

        $DAL = new DAL_Dikbud();
        $helper = new HukorHelper();

        $data = $DAL->GetAllLink();

        foreach($data as $dat)
        {
            if(!in_array($dat->id, $input['id']))
            {
                $helper->DeleteFile('link', $dat->gambar);
            }
        }

        DB::table('link_dikbud')->truncate(); //truncate table dikbud

        for($x = 0; $x < count($input['link']); $x++)
        {
            if($input['gambar'][$x] == "" || empty($input['gambar'][$x]))
            {
                foreach($data as $dt)
                {
                    if($input['id'][$x] == $dt->id)
                    {
                        $DAL->InsertToTable($input['link'][$x], $dt->gambar);
                    }
                }
            }
            else
            {
                $uploadSuccess = $helper->UploadFile('link', $input['gambar'][$x]);

                if($uploadSuccess)
                {
                    $DAL->InsertToTable($input['link'][$x], $input['gambar'][$x]);
                }
            }
        }

        return Redirect::to('admin/linked')->with('success', 'Data Berhasil Di Simpan.');
    }
}