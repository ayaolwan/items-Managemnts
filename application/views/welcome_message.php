<html lang="en">
<head>
	<title>Items Management</title>

	<!-- Fonts -->
	<link href='//fonts.googleapis.com/css?family=Roboto:400,300' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css">

    <link rel="stylesheet" href="app/services/datatables.bootstrap.css" />
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.5/css/jquery.dataTables.min.css" />
    <link rel="stylesheet" href="assets/angucomplete-master/angucomplete.css" />

	<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="//cdn.datatables.net/1.10.5/js/jquery.dataTables.min.js"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.1/js/bootstrap.min.js"></script>

	
	<!-- Angular JS -->
	<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.3.2/angular.min.js"></script>  
	<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.3.2/angular-route.min.js"></script>
    <script src="assets/angular-modal-service-master/dst/angular-modal-service.min.js"></script>

    <script src="assets/angucomplete-master/angucomplete.js"></script>

    <script src="app/services/angular-datatables.js"></script>


	<!-- MY App -->
	<script src="app/packages/dirPagination.js"></script>
	<script src="app/routes.js"></script>
	<script src="app/services/myServices.js"></script>
	<script src="app/helper/myHelper.js"></script>

	<!-- App Controller -->
	<script src="app/controllers/ItemController.js"></script>

</head>
<body ng-app="main-App">
	<div class="container">
		<ng-view></ng-view>
	</div>
<script>
    var base_url = window.location.protocol + '//' + window.location.hostname + '/itemsmanagemnts/';
</script>
</body>
</html>
