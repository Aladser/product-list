<!doctype html>
<html lang="en">
  <head>
    <title>Send Email Using PHPMailer in Laravel</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  </head>
  <body>
      <div class="container pt-5 pb-5">
        <div class="row">
            <div class="col-xl-6 col-lg-6 col-sm-12 col-12 m-auto">
                <form action="{{route('send-email')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="card shadow">
 
                        @if(Session::has("success"))
                            <div class="alert alert-success alert-dismissible"><button type="button" class="close">&times;</button>{{Session::get('success')}}</div>
                        @elseif(Session::has("failed"))
                            <div class="alert alert-danger alert-dismissible"><button type="button" class="close">&times;</button>{{Session::get('failed')}}</div>
                        @endif
 
                        <div class="card-header">
                            <h4 class="card-title">Send Email Using PHPMailer</h4>
                        </div>
 
                        <div class="card-body">
                            <div class="form-group">
                                <label for="emailRecipient">Получатель </label>
                                <input type="email" name="emailRecipient" id="emailRecipient" class="form-control" placeholder="Получатель">
                            </div>

 
                            <div class="form-group">
                                <label for="emailSubject">Заголовок </label>
                                <input type="text" name="emailSubject" id="emailSubject" class="form-control" placeholder="Заголовок">
                            </div>
 
                            <div class="form-group">
                                <label for="emailBody">Сообщение </label>
                                <textarea name="emailBody" id="emailBody" class="form-control" placeholder="Сообщение"></textarea>
                            </div>
                        </div>
 
                        <div class="card-footer">
                            <button type="submit" class="btn btn-success">Send Email </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
      </div>
      
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  </body>
</html>