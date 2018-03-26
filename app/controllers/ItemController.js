app.controller('itemDialogController', function($http,$scope,$rootScope,Items,uploadFile,ModalService)
{
    $scope.showError=false;
    $scope.showFilesError=false;
    $scope.itemsDatas=Items;

    $scope.item =
        {
            Id:'',
            Name:'',
            Description: '',
            Tags:'',
            Picture:''

        };


    $scope.verifyTags = function(inputValue)
    {
        var keepGoing = true;

        angular.forEach($scope.itemsDatas, function (i)
        {
            if(keepGoing) {
                if (inputValue == i.Tags)
                {
                    $scope.showError = true;
                    keepGoing = false;
                }
                else {
                    $scope.showError = false;
                }
            }
        });

    };


    $scope.uploadedFile = function(element)
    {
        var reader = new FileReader();
        reader.onload = function(event)
        {
            $scope.$apply(function($scope)
            {
                $scope.files = element.files;
                $scope.src = event.target.result
            });
        }
        reader.readAsDataURL(element.files[0]);

        $scope.showError=false;
    }


    $scope.itemsAdd = function()
    {

        if($scope.files)
        {
            $scope.myFile = $scope.files[0];
            var file = $scope.myFile;


            var formData = new FormData();

            angular.forEach($scope.myFile, function (obj)
            {
                formData.append('files[]', obj);
            });

            formData.append('name', $scope.form.title);
            formData.append('descrption', $scope.form.description);
            formData.append('tags', $scope.tags);
            formData.append('picture', $scope.myFile);

            $http({
                method: 'POST',
                url: base_url + "Items/items_add",
                data: formData,
                transformRequest: angular.identity,
                headers: {'Content-Type': undefined},
            }).success(function (response)
            {
                if (response.result)
                {
                    closeDialog();
                    $scope.item.Name = $scope.form.title;
                    $scope.item.Description = $scope.form.description;
                    $scope.item.Tags = $scope.tags;
                    $scope.item.Picture = response.file;
                    $scope.itemsDatas.unshift($scope.item);
                    $scope.item={};
                }
                else
                {

                }

            }).error(function (data, status, headers, config,xhr,error)
            {
            });
        }
        else
        {
            $scope.showFilesError=true;
        }

    }

    function closeDialog()
    {
        ModalService.closeModals();
    }

});

app.controller('ItemController', function(dataFactory,$scope,$http,ModalService,DTOptionsBuilder, DTColumnDefBuilder, DTInstances)
{
    // $scope.dtOptions = DTOptionsBuilder.newOptions().withPaginationType('full_numbers');

    $scope.currentPage=1;
    $scope.pageSize = 5;

    $scope.dtOptions = DTOptionsBuilder.newOptions()
        .withOption('paging', false)
        .withOption('responsive', true)
        .withOption('ordering', true)
        .withOption('info', false)
        .withOption('lengthChange', false)
        .withOption('searching', false);


    $scope.dtColumnDefs = [
            DTColumnDefBuilder.newColumnDef(0),
            DTColumnDefBuilder.newColumnDef(1),
            DTColumnDefBuilder.newColumnDef(2),
            // DTColumnDefBuilder.newColumnDef(3).notSortable()
        ];

    $scope.getItems = function()
    {
        $http({
            method: 'POST',
            url: base_url + "Items/get_all_items",
            headers: {'Content-Type': 'application/json'},
        }).success(function (response)
        {
            $scope.itemsData = response;

        }).error(function (response,status)
        {
        });

    }

    $scope.showAModal = function() {

        ModalService.showModal({
            templateUrl: "app/controllers/dialog.html",
            controller: "itemDialogController",
            inputs: {
                Items: $scope.itemsData,
            },
        }).then(function(modal)
        {
            modal.element.modal();
            modal.close.then(function(result)
            {
                $scope.message = result ? "You said Yes" : "You said No";
            });
        });

    };


});