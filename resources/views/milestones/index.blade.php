@extends('index')
@section('title', 'Milestones')

@section('projects')
    @includeIf('projects.list')
@endsection

@section('milestones')
    @includeIf('milestones.list')
@endsection
