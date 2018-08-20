<!DOCTYPE html>
<html lang="en">
<head>
    <title>Ex4</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://blackrockdigital.github.io/startbootstrap-sb-admin-2/dist/css/sb-admin-2.css">
</head>
<body>

    <div class="container">
        <h2>Ex4</h2>

    </div>
    <div class="row">

        <div class="col-lg-4">
            <div class="panel-heading">
                <h1>Add Product</h1>
            </div>
            <form role="form" action="/exercise-four/add-menu" method="POST"> @csrf

                <div class="panel-body">
                    <div class="form-group">
                        <label class="control-label" >Name category</label>
                        <input type="text" name="name_menu" class="form-control">
                    </div>
                    <div class="list-group">
                        <div class="form-group">
                            <label>Select menu</label>
                            <select  class="form-control" name="choose-menu">
                                <option value="0"> -- </option>
                                @if(isset($menuSql) && !empty($menuSql))
                                    @foreach ($menuSql as $key => $value)
                                        <option value="{!! $value['id'] !!}">{!! $value['name_menu'] !!}</option>
                                    @endforeach

                                @endif

                            </select>
                        </div>
                    </div>
                    <!-- /.list-group -->
                    <button  class="btn btn-default btn-block">Add</button>
                </div>
            </form>

        </div>
        <div class="col-lg-6">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Lists Product
                </div>
                <div class="panel-body">
                    <h4>Unordered List</h4>
                    <ul>
                        @if(isset($menuSql) && !empty($menuSql))
                            @foreach ($menuSql as $key => $value)
                                @if($value['parent']===0)
                                <?php    $submenu = DB::table('menu')->where('parent', $value['id'])->get()->toArray();

                                ?>
                                <li>{!! $value['name_menu'] !!}</li>
                                    @if(isset($submenu) && !empty($submenu))
                                    <ul>
                                        @foreach ($submenu as $k => $v)
                                        <li>{!! $v->name_menu !!}</li>
                                        @endforeach
                                    </ul>
                                    @endif
                                @endif
                            @endforeach


                        @endif
                    </ul>

                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
        </div>
    </div>


</body>
</html>
