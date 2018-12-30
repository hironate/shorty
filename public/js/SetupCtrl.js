shorty.directive('setupTooltip', function() {
    return {
        scope: {
            content: '@',
        },
        replace: true,
        template: '<button data-content="{{ content }}" type="button" class="btn btn-xs btn-default setup-qmark" data-toggle="popover">?</button>'
    }
});

shorty.controller('SetupCtrl', function($scope) {
    $scope.init = function () {
        $('[data-toggle="popover"]').popover({
            trigger: "hover",
            placement: "right"
        });
    };

    $scope.init();
});
