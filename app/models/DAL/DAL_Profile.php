<?php
class DAL_Profile {

    public function InsertToTable($input) {

        $data = new Profile();

        $data->visi = ($input['visi']) ? $input['visi'] : "";
        $data->misi = ($input['misi']) ? $input['misi'] : "";
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

        $data->visi = ($input['visi']) ? $input['visi'] : "";
        $data->misi = ($input['misi']) ? $input['misi'] : "";
        $data->gambar = (is_string($input['gambar'])) ? $input['gambar'] : $input['gambar']->getClientOriginalName();

        $data->save();
    }
}