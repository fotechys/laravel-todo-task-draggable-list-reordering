<!-- Project Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('project_id', 'Project:') !!}
    {!! Form::select('project_id', $projectItems, $project_id, ['class' => 'form-control custom-select']) !!}
</div>

