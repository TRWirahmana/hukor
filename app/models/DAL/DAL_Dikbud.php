<?php

class DAL_Dikbud
{
    /**
     * fungsi untuk insert data ke table link_dikbud
     */
    public function InsertToTable($input, $file)
    {
        $dikbud = new Dikbud();

        //pasrse input data to fields
        $dikbud->link = $input;
        $dikbud->gambar = (!is_string($file)) ? $file->getClientOriginalName() : $file;

        $dikbud->save();
    }

    /**
     * fungsi untuk mengambil seluruh data di tabel link_dikbud
     */
    public function GetAllLink()
    {
        return Dikbud::all();
    }

}
