<!DOCTYPE html>
<html lang="en">
<head>
    <title>Bootstrap Example</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container">
    <div class="row">
        <div class="col-lg-2"></div>
        <div class="col-lg-8">
            <div class="card mt-3">
                <h5 class="card-header">Login</h5>
                <div class="card-body">
                    <form action="{{ route('postLogin') }}">
                        <div class="form-group">
                            <label>Email</label>
                            <input name="email" type="text" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <input name="password" type="text" class="form-control">
                        </div>
                        <div class="d-flex justify-content-center">
                            <button type="submit" class="btn btn-secondary mr-4">Cancel</button>
                            <button type="submit" class="btn btn-primary">Login</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-lg-2"></div>
    </div>
</div>

</body>
</html>
