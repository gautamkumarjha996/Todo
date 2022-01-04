<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
         AllTask
        
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <div class="card">
                      @if(session('success'))
                      <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>{{session('success')}}</strong>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      @endif

                        <div class="card-header">
                            All Task
                        </div>
                 
                <table class="table">
                    <thead>
                      <tr>
                        <th scope="col">SrNo</th>
                        <th scope="col"> Task Name</th>
                        <th scope="col">User Name</th>
                        <th scope="col">Created At</th>
                        <th scope="col">Status</th>
                        <th scope="col">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                    <!-- @php($i=1) ---->
                  @foreach($tasklists as $tasklist)
                      <tr>
                        <th scope="row">{{$tasklists->firstItem()+$loop->index}}</th>
                        <td>{{$tasklist->name}}</td>
                        <td>{{$tasklist->user->name}}</td> 
                        <td>
                          @if($tasklist->created_at==NULL)
                          <span class="text-danger">No Date Set</span>
                          @else
                          {{carbon\carbon::parse($tasklist->created_at)->diffForHumans()}}
                          @endif
                        </td>
                        <td>
                        @if($tasklist->status==0)
                        <a href="{{url('tasklist/status/0')}}/{{$tasklist->id}}"><button type="button" class="btn btn-primary">NO</button></a>
                        @elseif($tasklist->status==1)
                         <button type="button" class="btn btn-success">Completed</button>
                        @endif
                        </td>
                      
                        <td>
                          @if($tasklist->status==1)
                          <a href="{{ url('tasklist/edit/'.$tasklist->id)}} " class="btn btn-info disabled" >Edit</a>
                          @elseif($tasklist->status==0)
                          <a href="{{ url('tasklist/edit/'.$tasklist->id)}}" class="btn btn-info">Edit</a>
                          @endif
                          <a href="{{ url('delete/tasklist/'.$tasklist->id)}}" class="btn btn-danger">Delete</a>
                        </td>
                      </tr>
                      @endforeach
                    
                    </tbody>
                  </table> 
                  {{ $tasklists->links() }}
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        Add Task
                    </div>
                    <div class="card-body">
                    <form action="{{route('store.tasklist')}}" method="POST">
                        @csrf
                        <div class="form-group">
                          <label for="exampleInputEmail1">Task Name</label>
                          <input type="text" name="name" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Task">
                          @error('name')
                          <span class="text-danger">{{ $message}}</span>
                          @enderror
                         
                        
                        </div>
                       
                        <button type="submit" class="btn btn-primary">AddTask</button>
                      </form>
                    </div>
                </div>
            </div>

            </div>
        </div>
       <!--- display the count-----data-->
       <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="card">
              

                    <div class="card-header">
                        All Display Count Data
                    </div>
             
            <table class="table">
                <thead>
                  <tr>
                    <th scope="col">Today</th>
                    <th scope="col"> Week</th>
                    <th scope="col">Month</th>
                  </tr>
                </thead>
                <tbody>
            
                  <tr>
          
                    <td>{{$todays}}</td>
                    <td>{{$current_weeks}}</td>  
                  <td>{{$months}}</td>
                    
                  </tr>
                
                </tbody>
              </table> 
            
            </div>
        </div>
        <div class="col-md-4">
       
        </div>

        </div>
    </div>
    <!---End count data-->
    
       
    </div>
</x-app-layout>
