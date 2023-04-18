<?php

namespace App;

class Question
{
	protected $number;
	protected $question;
	protected $choices;
	protected $answer;

	public function __construct($number, $question, $choices, $answer)
	{
		$this->number = $number;
		$this->question = $question;
		$this->choices = $choices;
		$this->answer = $answer;
	}

	public function getNumber()
	{
		return $this->number;
	}

	public function getQuestion()
	{
		return $this->question;
	}

	public function getChoices()
	{
		return $this->choices;
	}

	public function getAnswer()
    {
        return $this->answer;
    }
}