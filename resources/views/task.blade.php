@extends('layouts.app')


@section('content')
<div class="card">
  <div class="card-header">新規タスク</div>
  <form class="card-body my-card-body" action="{{ route('task_store') }}" method="POST">
    @csrf
    <input  class="form-control w-50 mb-3" type="text" name="task_name" placeholder="タスク名を入力してください">
    <div class="form-group">
      <textarea class="form-control" name="content" rows="3" placeholder="タスクの内容を入力してください"></textarea>
    </div>

    <div>期　日：</div>

    <div class="form-group">
      <label for="">優先度：</label>
      <div class="form-check form-check-inline">
        <input class="form-check-input" type="radio" name="priority" id="priorityA" value="A">
        <label class="form-check-label" for="priorityA">A</label>
      </div>
      <div class="form-check form-check-inline">
        <input class="form-check-input" type="radio" name="priority" id="priorityB" value="B">
        <label class="form-check-label" for="priorityB">B</label>
      </div>
      <div class="form-check form-check-inline">
        <input class="form-check-input" type="radio" name="priority" id="priorityC" value="C">
        <label class="form-check-label" for="priorityC">C</label>
      </div>
      <div class="form-check form-check-inline">
        <input class="form-check-input" type="radio" name="priority" id="priorityD" value="D">
        <label class="form-check-label" for="priorityD">D</label>
      </div>
    </div>

    <div class="form-group">
      <label for="">進　捗：</label>
      <div class="form-check form-check-inline">
        <input class="form-check-input" type="radio" name="status" id="status1" value="1" checked="checked">
        <label class="form-check-label" for="status1">未着手</label>
      </div>
      <div class="form-check form-check-inline">
        <input class="form-check-input" type="radio" name="status" id="status2" value="2">
        <label class="form-check-label" for="status2">進行中</label>
      </div>
      <div class="form-check form-check-inline">
        <input class="form-check-input" type="radio" name="status" id="status3" value="3">
        <label class="form-check-label" for="status3">完了</label>
      </div>
    </div>

    <div calss="form-group">
      @foreach($tags as $t)
      <div class="form-check form-check-inline">
        <input class="form-check-input" type="checkbox" id="{{ $t['id'] }}" value="{{ $t['id'] }}">
        <label class="form-check-label" for="{{ $t['id'] }}">{{ $t['name'] }}</label>
      </div>
      @endforeach
    </div>

    <input class="form-control w-50 mb-3" type="text" name="new_tag" placeholder="新しいタグを入力">
    <button type="submit" class="btn btn-primary">保存</button>
  </form>
</div>






@endsection
