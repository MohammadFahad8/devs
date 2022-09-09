@extends('layouts.app')
@section('content')
<table class="table-hovered table">
<thead>
  <tr>
    <th>Title</th>
    <th>Body</th>
    <th>Tags</th>
    <th><input type="text" placeholder="Search..." class="search"></th>
  </tr>
</thead>
<tbody id="book-results">
@each('books._bookslist',$books,'book','books._norecords')
</tbody>
</table>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script>
  $(document).ready(function(){
    $('.search').on('keyup',function(){
      $.ajax({
  headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    data: 'query='+$(this).val(),
  method:'GET',
  url:"/bookme/search"
}).done(function( msg ) {
  console.log('dev',msg)
  $("#book-results").html(msg)
        if(msg.error == 0){
            //$('.sucess-status-update').html(msg.message);
            console.log(msg.message);
        }else{
            console.log(msg.message);
            //$('.error-favourite-message').html(msg.message);
        }
    });
    })

  })
</script>
@endsection
