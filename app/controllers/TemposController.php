<?php

class TemposController extends BaseController {

	/**
	 * Color Repository
	 *
	 * @var Color
	 */
	protected $tempo;

	public function __construct(Tempo $tempo)
	{
		$this->tempo = $tempo;
	}



}
