<div>

    <ul class="list-unstyled">
        <li>
            <form wire:submit.prevent="addcomment">
                <div class="form-group">
                    <div class="input-group">
                        <input type="text" name="description" id="description" wire:model="description" class="form-control rounded-0 outline-none shadow-none " autocomplete="off"
                        placeholder="Comment here...">
                        <button type="button" wire:click="addcomment" class="btn btn-info text-white"><i class="fas fa-paper-plane"></i></button>
                    </div>
                   
                </div>
            </form>
        </li>
    </ul>
    <ul  class="list-unstyled" style="max-height: 500px; overflow-x:scroll;">
        @foreach ($comments as $comment)
            <li class="">
                <p>
                    {{$comment->description}}
                </p>
                <div class="d-flex justify-content-end">
                    <small class="fw-bold">{{$comment->user->name}} | <small class="fw-normal">{{ $comment->created_at->diffForHumans()}}</small></small> 
                
                </div>
            </li>
        @endforeach

        
    </ul>
</div>
