



 
<div class="dropdown show">
  <a class="btn btn-info dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
  Actions
  </a>
  <div class="dropdown-menu" aria-labelledby="dropdownMenuLink"> 
    <a href="{{ route($routeKey.'.details', [$row->id,$row->year_id,$row->classsetup_id]) }}" class="dropdown-item bg-dark text-white" > <i class="fa fa-edit"></i>  Edit</a>
 
<a href="{{ route($routeKey.'.destroy', $row->id) }}" class="dropdown-item bg-danger text-white btn-delete" ><i class="fa fa-trash"></i> Delete</a>
  </div>
</div>
 
 




