<!-- Project Id Field -->
<div class="col-sm-12">
    {!! Form::label('project_id', 'Project Name:') !!} : {{ $task->project->project_name }}
</div>

<!-- Task Name Field -->
<div class="col-sm-12">
    {!! Form::label('task_name', 'Task Name:') !!} : {{ $task->task_name }}
</div>

<!-- Created At Field -->
<div class="col-sm-12">
    {!! Form::label('created_at', 'Created At:') !!} : {{ $task->created_at }}
</div>

<!-- Updated At Field -->
<div class="col-sm-12">
    {!! Form::label('updated_at', 'Updated At:') !!} : {{ $task->updated_at }}
</div>

