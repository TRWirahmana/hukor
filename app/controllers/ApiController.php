<?php


class ApiController extends BaseController {

	public function getProvinsi() {
		$region_id = Input::get('id');
		$region = Region::find($region_id);
		return Response::json($region->provinsi);
	}

	public function getBpnb() {
		$id = Input::get('id');
		$provinsi = Provinsi::find($id);

		$lists = array("" => "-- Bpnb belum ditentukan --") + Bpnb::lists('nama', 'id');
		$lists['selected'] = $provinsi->bpnb_id;

		return Response::json($lists);
	}

	public function saveBpnb() {
		$input = Input::all();

		$provinsi = Provinsi::find($input['id']);
		if(null != $provinsi) {
			if($input['value'] == 0)
				$input['value'] = null;
			$provinsi->bpnb_id = $input['value'];
			$provinsi->save();
		}

		if($provinsi->bpnb != null)
			return $provinsi->bpnb->nama;
		else
			return "-- Bpnb belum ditentukan --";
	}

}