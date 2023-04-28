<!-- Project Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('project_id', 'Project:') !!}
    {!! Form::select('project_id', $projectItems, null, ['class' => 'form-control custom-select']) !!}
</div>


<!-- Task Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('task_name', 'Task Name:') !!}
    {!! Form::text('task_name', null, ['class' => 'form-control']) !!}
</div>

