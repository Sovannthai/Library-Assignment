<div class="modal fade" id="return-{{ $borrow->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-success">
                <h5 class="modal-title" id="exampleModalLabel">Return Book</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('return.input',['id'=>$borrow->id]) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group row">
                        <div class="col-sm-6">
                            <label for="">Return Date</label>
                            <input type="date" name="return_date" class="form-control" value="{{ $borrow->return_date }}">
                        </div>
                        <div class="col-sm-6">
                            <label for="">Find Amount</label>
                            <input type="number" name="find_amount" class="form-control" value="{{ $borrow->return_date }}" placeholder="Enter find amount">
                        </div>
                    </div>
                    <button type="submit" class="btn-primary btn-sm float-lg-right">Save</button>
                </form>
            </div>
        </div>
    </div>
</div>
