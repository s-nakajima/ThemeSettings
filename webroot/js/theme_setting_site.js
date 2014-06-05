var ThemeSettingThemeList = [];
var SnapshotNoImage = '/theme_setting/img/snapshot_noimage.png';


NetCommonsApp.controller('ThemeSettingsSiteIndexCtrl', function($scope) {

        $scope.ThemeList = [];
        $scope.searchQuery = '';
        $scope.query = '';
        $scope.setJson = function() {
            $scope.ThemeList = ThemeSettingThemeList;
        };
        //文字列 str を指定した幅 w で丸めます。
        $scope.strimwidth = function(text, s, w, marker) {
            var end = text.length;
            if (! s) {s = 0;}
            if (! w) {w = 100;}
            if (! marker) {marker = '...';}
            if (end < w) return text;
            return text.substring(s, w) + marker;
        };
        //snapshotのimgタグを返します
        $scope.snapshot = function(url) {
            if (url) {return url;}
            return SnapshotNoImage;
        };
        //フィルター実行
        $scope.setQuery = function() {
            $scope.sendQuery = $scope.query;
        };

        $scope.getQuery = function() {
            return $scope.sendQuery;
        };
});






