@extends('adminlte::page')

@section('title', __('menu.administration.configuration._title') . '/' . __('menu.administration.configuration.database._title'))

@section('content_header')
    <h1>@yield('title')</h1>
@stop

@section('content')
    @include('layouts.response_message')

    <form action="{{ route('admin.config.store') }}" method="post">
        @csrf
        @method('patch')
        <input type="hidden" name="_redirectTo" value="admin.config.database">
        <div class="row">
            <div class="col-md-6">
                <x-adminlte-card title="{{ __('config.database.server.title') }}" theme="lightblue" theme-mode="outline"
                                 icon="fas fa-fw fa-database">
                    <x-adminlte-input name="hostname" label="{{ __('config.database.server.hostname') }}"
                                      value="{{ $hostname }}"/>
                    <x-adminlte-input name="port" label="{{ __('config.database.server.port') }}" value="{{ $port }}"/>
                    <x-adminlte-input name="database" label="{{ __('config.database.server.database') }}"
                                      value="{{ $database }}"/>
                </x-adminlte-card>
            </div>
            <div class="col-md-6">
                <x-adminlte-card title="{{ __('config.database.user.title') }}" theme="lightblue" theme-mode="outline"
                                 icon="fas fa-fw fa-user">
                    <x-adminlte-input name="username" label="{{ __('config.database.user.username') }}"
                                      value="{{ $username }}"/>
                    <x-adminlte-input name="password" label="{{ __('config.database.user.password') }}"
                                      value="{{ $password }}"/>
                </x-adminlte-card>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <x-adminlte-button type="submit" class="d-flex ml-auto" theme="primary" label="{{ __('commons.save') }}"/>
            </div>
        </div>
    </form>
@stop

