@extends('admin.layouts.master')
@section('title', 'E-Learning | Course Details')
@section('content')
        <!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>E-learning :: Course Details</h3>
            </div>
        </div>

        <div class="clearfix"></div>

        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Course - {{ $teacherCourse->course->title }} Details</h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                            </li>
                            <li><a class="close-link"><i class="fa fa-close"></i></a>
                            </li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <div class="product-image">
                                <img src="{{ url($teacherCourse->course->featured_image) }}" alt="..." />
                            </div>
                        </div>
                        <div class="col-md-5 col-sm-5 col-xs-12" style="border:0px solid #e5e5e5;">

                            <h3 class="prod_title">{{ $teacherCourse->course->title }}</h3>

                            <p>Raw denim you probably haven't heard of them jean shorts Austin. Nesciunt tofu stumptown aliqua butcher retro keffiyeh dreamcatcher synth. Cosby sweater eu banh mi, qui irure terr.</p>
                            <br />

                            <div class="">
                                <h2>Available Colors</h2>
                                <ul class="list-inline prod_color">
                                    <li>
                                        <p>Green</p>
                                        <div class="color bg-green"></div>
                                    </li>
                                    <li>
                                        <p>Blue</p>
                                        <div class="color bg-blue"></div>
                                    </li>
                                    <li>
                                        <p>Red</p>
                                        <div class="color bg-red"></div>
                                    </li>
                                    <li>
                                        <p>Orange</p>
                                        <div class="color bg-orange"></div>
                                    </li>

                                </ul>
                            </div>
                            <br />

                            <div class="">
                                <h2>Size <small>Please select one</small></h2>
                                <ul class="list-inline prod_size">
                                    <li>
                                        <button type="button" class="btn btn-default btn-xs">Small</button>
                                    </li>
                                    <li>
                                        <button type="button" class="btn btn-default btn-xs">Medium</button>
                                    </li>
                                    <li>
                                        <button type="button" class="btn btn-default btn-xs">Large</button>
                                    </li>
                                    <li>
                                        <button type="button" class="btn btn-default btn-xs">Xtra-Large</button>
                                    </li>
                                </ul>
                            </div>
                            <br />

                            <div class="">
                                <div class="product_price">
                                    <h1 class="price">Teacher/Author : {{ $teacherCourse->teacher->user->name }}</h1>
                                    <span class="price-tax">user since {!! \App\Libraries\TimeStampToAgoHelper::time_elapsed_string($teacherCourse->teacher->user->created_at) !!}</span>
                                    <br>
                                </div>
                            </div>

                            <div class="">
                                <button type="button" class="btn btn-default btn-lg">Add to Cart</button>
                                <button type="button" class="btn btn-default btn-lg">Add to Wishlist</button>
                            </div>

                        </div>


                        <div class="col-md-12">

                            <div class="" role="tabpanel" data-example-id="togglable-tabs">
                                <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
                                    <li role="presentation" class="active"><a href="#tab_content1" id="home-tab" role="tab" data-toggle="tab" aria-expanded="true">Home</a>
                                    </li>
                                    <li role="presentation" class=""><a href="#tab_content2" role="tab" id="profile-tab" data-toggle="tab" aria-expanded="false">Profile</a>
                                    </li>
                                    <li role="presentation" class=""><a href="#tab_content3" role="tab" id="profile-tab2" data-toggle="tab" aria-expanded="false">Profile</a>
                                    </li>
                                </ul>
                                <div id="myTabContent" class="tab-content">
                                    <div role="tabpanel" class="tab-pane fade active in" id="tab_content1" aria-labelledby="home-tab">
                                        <p>Raw denim you probably haven't heard of them jean shorts Austin. Nesciunt tofu stumptown aliqua, retro synth master cleanse. Mustache cliche tempor, williamsburg carles vegan helvetica. Reprehenderit butcher retro keffiyeh dreamcatcher
                                            synth. Cosby sweater eu banh mi, qui irure terr.</p>
                                    </div>
                                    <div role="tabpanel" class="tab-pane fade" id="tab_content2" aria-labelledby="profile-tab">
                                        <p>Food truck fixie locavore, accusamus mcsweeney's marfa nulla single-origin coffee squid. Exercitation +1 labore velit, blog sartorial PBR leggings next level wes anderson artisan four loko farm-to-table craft beer twee. Qui photo
                                            booth letterpress, commodo enim craft beer mlkshk aliquip</p>
                                    </div>
                                    <div role="tabpanel" class="tab-pane fade" id="tab_content3" aria-labelledby="profile-tab">
                                        <p>xxFood truck fixie locavore, accusamus mcsweeney's marfa nulla single-origin coffee squid. Exercitation +1 labore velit, blog sartorial PBR leggings next level wes anderson artisan four loko farm-to-table craft beer twee. Qui
                                            photo booth letterpress, commodo enim craft beer mlkshk </p>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /page content -->

@stop