<?php
class DikbudController extends BaseController {

    protected $layout = 'layouts.admin';

    public function index()
    {
        $data = Dikbud::all();

        if(count($data->toArray()) != 0)
        {
            $this->layout->content = View::make('dikbud.edit', array(
                'title' => 'Pengaturan Link',
                'detail' => '',
                'form_opts' => array(
                    'action' => array('DikbudController@update', 1),
                    'enctype' => 'multipart/form-data',
                    'method' => 'post',
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

    public function update()
    {
        echo "<pre>";
        print_r('a');
        echo "</pre>";
        exit;
    }
}