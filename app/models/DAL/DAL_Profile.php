<?php
class DAL_Profile {

    public function InsertToTable($input) {

        $data = new Profile();

        $data->isi = ($input['isi']) ? $input['isi'] : "";
        $data->gambar = ($input['gambar']) ? $input['gambar']->getClientOriginalName() : "";

        $data->save();

    }

    public function GetProfile()
    {
        return Profile::find(1);
    }

    public function UpdateProfile($input)
    {
        $data = $this->GetProfile();

        $data->isi = ($input['isi']) ? $input['isi'] : "";
        $data->gambar = (is_string($input['gambar'])) ? $input['gambar'] : $input['gambar']->getClientOriginalName();

        $data->save();
    }
}