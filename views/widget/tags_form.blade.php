<?php /**
 * @var \Minhbang\Layout\Widget $widget
 * @var \Illuminate\Support\MessageBag $errors
 */ ?>
@extends('kit::backend.layouts.modal')
@section('content')
    {!! Form::model($data,['class' => 'form-modal','url' => $url, 'method' => 'put']) !!}
    <div class="row">
        <div class="col-xs-8">
            <div class="form-group {{ $errors->has("tag_type") ? ' has-error':'' }}">
                {!! Form::label("tag_type", $labels['tag_type'], ['class' => "control-label"]) !!}
                {!! Form::select('tag_type', $widget->typeInstance()->getTagTypes(), null, ['prompt' => __('Select Tag type...'), 'class' => 'form-control selectize']) !!}
                @if($errors->has('tag_type'))
                    <p class="help-block">{{ $errors->first('tag_type') }}</p>
                @endif
            </div>
            <div class="form-group {{ $errors->has("route_show") ? ' has-error':'' }}">
                {!! Form::label("route_show", $labels['route_show'], ['class' => "control-label"]) !!}
                {!! Form::select(
                    "route_show", $widget->typeInstance()->getRoutes(), null, ['prompt' => __('Select route...'), 'class' => 'form-control selectize'])
                !!}
                @if($errors->has('route_show'))
                    <p class="help-block">{{ $errors->first('route_show') }}</p>
                @endif
            </div>
        </div>
        <div class="col-xs-4">
            <div class="form-group{{ $errors->has('tag_css') ? ' has-error':'' }}">
                {!! Form::label('label', $labels['tag_css'], ['class' => 'control-label']) !!}
                {!! Form::text('tag_css', null, ['class' => 'form-control']) !!}
                @if($errors->has('tag_css'))
                    <p class="help-block">{{ $errors->first('tag_css') }}</p>
                @endif
            </div>
            <div class="form-group {{ $errors->has("show_count") ? ' has-error':'' }}">
                {!! Form::label("show_count",  $labels['show_count'], ['class'=> 'control-label']) !!}
                <br>
                {!! Form::checkbox("show_count", 1, null,['class'=>'switch', 'data-on-text'=>__('Yes'), 'data-off-text'=>__('No')]) !!}
                @if($errors->has("show_count"))
                    <p class="help-block">{{ $errors->first("show_count") }}</p>
                @endif
            </div>
        </div>
    </div>
    @include('layout::widgets._common_fields')
    {!! Form::close() !!}
@stop