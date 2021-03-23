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
    $scope.product = {
        product_name: "",
        product_sku: "",
        product_slug: "",
        product_description: "",
        product_categories: [],
        product_upc: "",
        product_quantity: 0,
        product_out_of_stock_status: "INSTOCK",
        date_of_available: "",
        product_status: "Enabled",
        primary_image: "",
        product_images: [],
        related_products: [],
        product_options: [{
            option_name: "",
            options_values: [
                {
                    option_value: "",
                    option_quantity: 0,
                    price_inc_dec_delemeter: "",
                    price: ""
                }
            ]
        }],
        gross_total: 0,
        packing_cost: 0,
        product_cost: 0,
        shipping_cost: 0,
        other_cost: 0,
        tax_percent: 0,
        total_cost: 0,
        discount_price: 0,
        discount_date_start: "",
        discount_date_end: "",
        meta_tag_title: "",
        meta_tag_keyword: "",
        meta_tag_description: "",
        require_shipping: "FREE",
        shipping_width: 0,
        shipping_height: 0,
        shipping_length: 0,
        shipping_weight: 0
    }
    $scope.addoption = function () {
        $scope.product.product_options.push({
            option_name: "",
            options_values: [
                {
                    option_value: "",
                    option_quantity: 0,
                    price_inc_dec_delemeter: "",
                    price: ""
                }
            ]
        })
    }
    $scope.addoptionvalue = function (index) {
        $scope.product.product_options[index].options_values.push({
            option_value: "",
            option_quantity: 0,
            price_inc_dec_delemeter: "",
            price: ""
        })
    }
    $scope.removeoptionvalue = function (index, jindex) {
        $scope.product.product_options[index].options_values.splice(jindex, 1);
    }
    $scope.removeoption = function (index) {

        $scope.product.product_options.splice(index, 1);
    }
    $scope.createId = function (id, index) {
        return id + "_" + index;
    }
    $scope.openMedia = function () {
        $("#mediaModal").modal();
        $(".file-preview").each(function () {
            $(this).removeClass("selected")
        });
    }
    $scope.removeSelectedImage = function (index, item) {
        $scope.product.product_images.splice(index, 1);
        if (item.id == $scope.product.primary_image) {
            if ($scope.product.product_images.length != 0) {
                $scope.product.primary_image = $scope.product.product_images[0].id;
            }
        }
    }
    $scope.selectMedia = function () {
        let count = 0;
        $(".file-preview").each(function () {
            if ($(this).hasClass("selected")) {
                let data = JSON.parse($(this).attr('data'));
                if (count == 0) {
                    $scope.product.primary_image = data.id;
                }
                $scope.product.product_images.push(data);
                count++;
            }
        })
        $("#mediaModal").modal('hide');
    }
    $scope.submitForm = function (isValid) {
        $scope.submitted = true;
        if (isValid) {
            $scope.submitted = false;
            console.log($scope.product);
            var req = {
                method: 'POST',
                url: '/textla/product/post-create',
                headers: {
                    'X-CSRF-Token': $('[name="_token"]').val()
                },
                data: $scope.product
            }
            $http(req).then(function successCallback(response) {
                $("#successModal").modal();
                //window.location.replace(response)
            }, function errorCallback(response) {
                console.log(response);
            });
        }
    };
    $scope.closeModel = function () {
        $("#successModal").modal('hide');
        window.location.href = "/textla/product";
    }
    $scope.calculatePrice = function () {
        let product_cost = $scope.product.product_cost ? parseFloat($scope.product.product_cost) : 0;
        let packing_cost = $scope.product.packing_cost ? parseFloat($scope.product.packing_cost) : 0;
        let shipping_cost = $scope.product.shipping_cost ? parseFloat($scope.product.shipping_cost) : 0;
        let other_cost = $scope.product.other_cost ? parseFloat($scope.product.other_cost) : 0;
        let tax_percent = $scope.product.tax_percent ? parseFloat($scope.product.tax_percent) : 0;
        let price = product_cost + packing_cost + shipping_cost + other_cost;
        $scope.product.gross_total = price;
        let calculateTax = (price * tax_percent) / 100;
        let totalCost = calculateTax + price;
        $scope.product.total_cost = Math.ceil(totalCost);
    }
});