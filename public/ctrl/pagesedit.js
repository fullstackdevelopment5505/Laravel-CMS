var app = angular.module('myApp', []);
app.config(config);
config.$inject = ['$interpolateProvider'];
function config($interpolateProvider) {
    $interpolateProvider.startSymbol('##');
    $interpolateProvider.endSymbol('##');
}
app.directive('ckEditor', function () {
    return {
        require: '?ngModel',
        link: function (scope, elm, attr, ngModel) {
            var ck = CKEDITOR.replace(elm[0], {
                toolbar: [
                    { name: 'clipboard', groups: ['clipboard', 'undo'], items: ['Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo'] },
                    { name: 'links', items: ['Link', 'Unlink'] },
                    { name: 'basicstyles', groups: ['basicstyles', 'cleanup'], items: ['Bold', 'Italic', 'Underline', 'Strike', 'Subscript', 'Superscript', '-', 'CopyFormatting', 'RemoveFormat'] },
                    { name: 'paragraph', groups: ['list', 'indent', 'blocks', 'align', 'bidi'], items: ['NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Blockquote', 'CreateDiv', '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock', '-', 'BidiLtr', 'BidiRtl', 'Language'] },
                    { name: 'tools', items: ['Maximize'] },
                    { name: 'styles', items: ['Styles', 'Format', 'Font', 'FontSize'] },
                    { name: 'colors', items: ['TextColor', 'BGColor'] },
                ]
            });

            if (!ngModel) return;

            ck.on('pasteState', function () {
                scope.$apply(function () {
                    ngModel.$setViewValue(ck.getData());
                });
            });

            ngModel.$render = function (value) {
                ck.setData(ngModel.$viewValue);
            };
        }
    };
});
app.controller('myCtrl', function ($scope, $http) {
    $scope.submitted = false;
    $scope.page = {
        id: "",
        page_title: "",
        page_description: "",
        page_thumbnail: "",
        meta_tag_title: "",
        meta_tag_keyword: "",
        meta_tag_description: ""
    }
    $scope.selectMedia = function () {
        let count = 0;
        $(".file-preview").each(function () {
            if ($(this).hasClass("selected")) {
                let data = JSON.parse($(this).attr('data'));
                $scope.page.page_thumbnail = data.id;
                $("#output").attr('src', '/public/' + data.media_url);
            }
        })
        $("#mediaModal").modal('hide');
    }
    $scope.openModel = function () {
        $("#mediaModal").modal();
        $(".file-preview").each(function () {
            $(this).removeClass("selected")
        });
        $(".file-preview").click(function () {
            $(".file-preview").each(function () {
                $(this).removeClass("selected")
            });
            $(this).toggleClass("selected");
        })
    }

    $scope.submitForm = function (isValid) {
        $scope.submitted = true;
        if (isValid) {
            $scope.submitted = false;
            console.log($scope.page);
            var req = {
                method: 'POST',
                url: '/textla/page/post-update',
                headers: {
                    'X-CSRF-Token': $('[name="_token"]').val()
                },
                data: $scope.page
            }
            $http(req).then(function successCallback(response) {
                $("#successModal").modal();
            }, function errorCallback(response) {
                console.log(response);
            });
        }
    };
    $scope.closeModel = function () {
        $("#successModal").modal('hide');
        window.location.href = "/textla/page";
    }

    $scope.init = function () {
        if (window.location.search.indexOf("=") != -1) {
            let id = window.location.search.split("=")[1];
            var req = {
                method: 'GET',
                url: '/textla/page/detail?id=' + id,
                headers: {
                    'X-CSRF-Token': $('[name="_token"]').val()
                }
            }
            $http(req).then(function successCallback(response) {
                if (response.data) {
                    $scope.page = response.data.page;
                }
            }, function errorCallback(response) {
                console.log(response);
            });
        }
    }()
});