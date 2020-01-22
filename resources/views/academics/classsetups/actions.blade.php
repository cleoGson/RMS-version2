



<div class="dropdown show">
  <a class="btn btn-info dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
  Actions
  </a>
  <div class="dropdown-menu" aria-labelledby="dropdownMenuLink"> 
    <a href="{{ route($routeKey.'.show', encrypt($row->id)) }}" class="dropdown-item bg-dark text-white" > <i class="fa fa-edit"></i>  Show</a>
    <a href="{{ route($routeKey.'.edit', encrypt($row->id)) }}" class="dropdown-item bg-dark text-white" > <i class="fa fa-edit"></i>  Edit</a>
 
<a href="{{ route($routeKey.'.destroy', encrypt($row->id)) }}" class="dropdown-item bg-danger text-white btn-delete" ><i class="fa fa-trash"></i> Delete</a>
  </div>
</div>
