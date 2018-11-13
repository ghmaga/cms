<?php

namespace App\Admin\Controllers;

use App\Models\Slide;
use App\Models\Category;

use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;

class SlideController extends Controller
{
    use HasResourceActions;

    /**
     * Index interface.
     *
     * @param Content $content
     * @return Content
     */
    public function index(Content $content)
    {
        return $content
            ->header('Index')
            ->description('description')
            ->body($this->grid());
    }

    /**
     * Show interface.
     *
     * @param mixed $id
     * @param Content $content
     * @return Content
     */
    public function show($id, Content $content)
    {
        return $content
            ->header('Detail')
            ->description('description')
            ->body($this->detail($id));
    }

    /**
     * Edit interface.
     *
     * @param mixed $id
     * @param Content $content
     * @return Content
     */
    public function edit($id, Content $content)
    {
        return $content
            ->header('Edit')
            ->description('description')
            ->body($this->form()->edit($id));
    }

    /**
     * Create interface.
     *
     * @param Content $content
     * @return Content
     */
    public function create(Content $content)
    {
        return $content
            ->header('Create')
            ->description('description')
            ->body($this->form());
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Slide);

        $grid->id('Id');
        // $grid->parent_id(trans('admin.parent_id'))->editable('select', Category::selectOptions());
        $grid->image(trans('admin.image'))->gallery(['zooming' => true]);
        // $grid->image(trans('admin.image'))->image('', 50, 50);
        $grid->title(trans('admin.title'))->editable();
        $grid->link(trans('admin.link'))->editable();
        $grid->order(trans('admin.order'))->editable();

        return $grid;
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     * @return Show
     */
    protected function detail($id)
    {
        $show = new Show(Slide::findOrFail($id));

        $show->id('Id');
        $show->parent_id(trans('admin.parent_id'));
        $show->image(trans('admin.image'));
        $show->title(trans('admin.title'));
        $show->link(trans('admin.link'));
        $show->order(trans('admin.order'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Slide);

        $form->select('parent_id', trans('admin.parent_id'))->options(Category::selectOptions());
        $form->image('image', trans('admin.image'))
             ->fit(300, 200, function ($constraint) {
                                            //等比缩放
                                            $constraint->aspectRatio();
                                            //防止图片放大
                                            $constraint->upsize();
                                            })
             ->rules('required|mimes:jpeg,png,gif')
             ->uniqueName()
             ->help('支持jpg,png,gif');
        $form->image('en_image', trans('admin.en_image'));
        $form->text('title', trans('admin.title'));
        $form->text('en_title', trans('admin.en_title'));
        $form->url('link', trans('admin.link'));
        $form->text('order', trans('admin.order'));

        return $form;
    }
}
