<?php

namespace App\Models\Traits\Chinawbk;

/**
 * Trait RoleAttribute.
 */
trait BlockAttribute
{
    /**
     * @return string
     */
    public function getStatusLabelAttribute()
    {
       if($this->isShow()) {
           return '<span class="badge badge-success">显示</span>';
       }
       return '<span class="badge badge-danger">隐藏</span>';

    }
    /**
     * @return string
     */
    public function getEditButtonAttribute()
    {
        return '<a href="'.route('admin.chinawbk.block.edit', $this).'" class="btn btn-primary"><i class="fas fa-edit" data-toggle="tooltip" data-placement="top"></i></a>';
    }

    /**
     * @return string
     */
    public function getDeleteButtonAttribute()
    {
        return '<a href="'.route('admin.chinawbk.block.destroy', $this).'"
			 data-method="delete"
			 data-trans-button-cancel="'.__('buttons.general.cancel').'"
			 data-trans-button-confirm="'.__('buttons.general.crud.delete').'"
			 data-trans-title="'.__('strings.backend.general.are_you_sure').'"
			 class="btn btn-danger"><i class="fas fa-trash" data-toggle="tooltip" data-placement="top"></i></a> ';
    }

    /**
     * @return string
     */
    public function getActionButtonsAttribute()
    {
        return '<div class="btn-group btn-group-sm" role="group" aria-label="">
			  '.$this->edit_button.'
			  '.$this->delete_button.'
			</div>';
    }
}
