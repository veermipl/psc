@extends('layout.admin_master')

@section('title', 'CMS - Contact Us')
@section('header', 'Contact Us')

@section('content')

    <div class="p-4 mb-3 bg-white">
        Lorem ipsum, dolor sit amet consectetur adipisicing elit. Facilis reiciendis laudantium atque! Ducimus non eaque
        hic aperiam, fugit consectetur ex ullam perferendis voluptate dolore? Magnam ducimus ad quidem soluta earum.

        {{ request()->is('admin/cms/contact-us') ? 'link-active' : 'no' }}
    </div>

@endsection
