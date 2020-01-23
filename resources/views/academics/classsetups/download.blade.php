<!DOCTYPE html>
<html>
<head>
{{ Html::style('css/bootstrap.css') }}
<style>
td{
    color:red
}
</style>  
</head>
<body>
<table>
<tbody>

   @foreach($show->subjectCurriculars as $subjcurricular)
    <tr><th>Code</th><th>{{$subjcurricular->name}}</th> <th>Display Name </th> <th>Units</th> <th>Status</th></tr>
   @foreach($subjcurricular->curricularSubjects as $subjects)
    <tr><td>{{$subjects->code}} </td> <td> {{$subjects->name}} </td> <td> {{$subjects->display_name}}</td> <td>{{$subjects->units}}</td> <td>  {!!$subjects->status==1 ? '<span class="badge-primary badge-pill">Compassary </span>': '<span class="badge-primary badge-pill">Optional</span>'!!} </td>
    </tr>
    @endforeach
  @endforeach
  </tbody>
</table>
</body>
</html>
