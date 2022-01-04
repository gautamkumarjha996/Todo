<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
         EditTask
        
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="container">
            <div class="row">
            
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        Edit Task
                    </div>
                    <div class="card-body">
                    <form action="{{ url('tasklist/update/'.$tasklists->id)}}" method="POST">
                        @csrf
                        <div class="form-group">
                          <label for="exampleInputEmail1">Task Name</label>
                          <input type="text" name="name" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{$tasklists->name}}" placeholder="Enter Task">
                          @error('name')
                          <span class="text-danger">{{ $message}}</span>
                          @enderror
                         
                        
                        </div>
                       
                        <button type="submit" class="btn btn-primary">UpdateTask</button>
                      </form>
                    </div>
                </div>
            </div>

            </div>
        </div>
       
       
    </div>
</x-app-layout>
