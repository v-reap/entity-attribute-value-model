<?php

namespace Eav\Controllers;

use App\Http\Controllers\Controller;
use Eav\Attribute;
use Eav\Entity;
use Encore\Admin\Controllers\ModelForm;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Column;
use Encore\Admin\Layout\Content;
use Encore\Admin\Layout\Row;

class AttributeController extends Controller
{
    use ModelForm;
    public function index()
    {
        $content = Admin::content();
        $content->header(trans('eav::eav.attributes').trans('eav::eav.list'));
        $content->description('...');

        $grid = Admin::grid(Attribute::class, function (Grid $grid) {
            $grid->column('attribute_id','ID')->sortable();
            $grid->column('entity_id',trans('eav::eav.entity'));
            $grid->column('attribute_code',trans('eav::eav.attribute_code'));
            $grid->column('backend_class',trans('eav::eav.backend_class'));
            $grid->column('backend_type',trans('eav::eav.backend_type'));
            $grid->column('backend_table',trans('eav::eav.backend_table'));
            $grid->column('frontend_class',trans('eav::eav.frontend_class'));
            $grid->column('frontend_type',trans('eav::eav.frontend_type'));
            $grid->column('frontend_label',trans('eav::eav.frontend_label'));
            $grid->column('source_class',trans('eav::eav.source_class'));
            $grid->column('default_value',trans('eav::eav.default_value'));
            $grid->column('is_filterable',trans('eav::eav.is_filterable'));
            $grid->column('is_searchable',trans('eav::eav.is_searchable'));
            $grid->column('is_required',trans('eav::eav.is_required'));
            $grid->column('required_validate_class',trans('eav::eav.required_validate_class'));
        });
        $content->body($grid);
        return $content;
    }

    /**
     * Edit interface.
     *
     * @param $id
     * @return Content
     */
    public function edit($id)
    {
        return Admin::content(function (Content $content) use ($id) {
            $content->header(trans('eav::eav.edit').trans('eav::eav.attributes'));
            $content->description('...');

            $content->body($this->form()->edit($id));
        });
    }

    /**
     * Create interface.
     *
     * @return Content
     */
    public function create()
    {
        return Admin::content(function (Content $content) {
            $content->header(trans('eav::eav.create').trans('eav::eav.attributes'));
            $content->description('...');
            $content->body($this->form());
        });
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        return Admin::form(Attribute::class, function (Form $form) {
            $form->display('attribute_id', 'ID');
            $form->text('attribute_code',trans('eav::eav.attribute_code'));
            $form->text('backend_class',trans('eav::eav.backend_class'));
            $form->select('backend_type',trans('eav::eav.backend_type'))->options(Attribute::backendType());
            $form->text('backend_table',trans('eav::eav.backend_table'));
            $form->text('frontend_class',trans('eav::eav.frontend_class'));
            $form->select('frontend_type',trans('eav::eav.frontend_type'))->options(Attribute::frontendType());
            $form->text('frontend_label',trans('eav::eav.frontend_label'));
            $form->text('source_class',trans('eav::eav.source_class'));
            $form->text('default_value',trans('eav::eav.default_value'));
            $form->select('is_filterable',trans('eav::eav.is_filterable'))->options(status());
            $form->select('is_searchable',trans('eav::eav.is_searchable'))->options(status());
            $form->select('is_required',trans('eav::eav.is_required'))->options(status());
            $form->text('required_validate_class',trans('eav::eav.required_validate_class'));
        });
    }
}
