      <div class="form-group row mb-0">
            <div class="col-md-6 offset-md-4">
            {{ Form::submit($name,array_merge(['class' => 'btn btn-success'], $attributes)) }}
              <a href="{{$url}}" class="btn btn-primary">
                {{ __('Canccel') }}
              </a>
            </div>
          </div>