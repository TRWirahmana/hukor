<?php

class BaseController extends Controller {

	/**
	 * Setup the layout used by the controller.
	 *
	 * @return void
	 */
	protected function setupLayout()
	{
		if ( ! is_null($this->layout))
		{
			$this->layout = View::make($this->layout);
		}
	}


    /*
     * Set php.ini Option on the fly
     */

    /*
     * Get Info Ini
     */
    protected function getIniStatus($value)
    {
        return ini_get($value);
    }

    /*
     * Set Ini value
     */
    protected function setIniStatus($key, $value)
    {
        ini_set($key, $value);
    }

}