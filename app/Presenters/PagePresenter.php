<?php 
namespace App\Presenters;

use Laracasts\Presenter\Presenter;

class PagePresenter extends Presenter{
    public function paddedTitle(){
        $pagging = str_repeat('&nbsp', $this->depth * 4);
        return $pagging.$this->title;
    }

    public function dropDownClass(){
        return $this->children->count() ? 'dropdown' : '';
    }
}