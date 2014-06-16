describe("theme_setting_site", function() {
    var $scope, $location, $rootScope, createController, scope;
    it("jasmine do test", function() {
         expect(true).toBe(true);
    });

    //load module
    beforeEach(module('NetCommonsApp'));

    //controller
    beforeEach(inject(function($controller){
        //spec body
        scope = {};
        var ThemeSettingsSiteIndexCtrl = $controller('ThemeSettingsSiteIndexCtrl', { $scope: scope });
        expect(ThemeSettingsSiteIndexCtrl).toBeDefined();
    }));

    //test
    //it('setQuery()', inject(function($controller) {
        //getQuery
        //expect(scope.getQuery()).toBe(scope.sendQuery);
        //setQuery
      //  scope.query = '';
      //  scope.setQuery();

        //expect('').toBe(scope.sendQuery);
        //scope.query = 'jasmine test';
        //scope.setQuery();
        //expect(scope.query).toBe(scope.sendQuery);
    //}));
    //test
    it('getQuery()', inject(function($controller) {
        scope.sendQuery = "";
        expect(scope.getQuery()).toBe(scope.sendQuery);
        expect(scope.getQuery()).toBe("");
        //getQuery
        scope.sendQuery = "hoge";
        expect(scope.getQuery()).toBe("hoge");
    }));
    //test
    it('strimwidth()', inject(function($controller) {
        //jasmineの０文字目から1文字目までを表示し、文末に...をつける
        expect(scope.strimwidth('jasmine' , 0 , 1, '...')).toBe('j...');
        //jasmineの1文字目から3文字目までを表示し、文末に---をつける
        expect(scope.strimwidth('jasmine' , 1 , 3, '---')).toBe('as---');
        //デェフォルト値によって, 0, 100, '...'が指定されている状態
        expect(scope.strimwidth('jasmine')).toBe('jasmine');
        //text 105文字 resolt 100文字 + ...
        var text = 'test1test1test1test1test1test1test1test1test1test1test1test1test1test1test1test1test1test1test1test1test1';
        var resolt = 'test1test1test1test1test1test1test1test1test1test1test1test1test1test1test1test1test1test1test1test1...';

    }));
    //test
    it('snapshot()', inject(function($controller) {
        //textが空の場合
        SnapshotNoImage = "/jasmine.test.jpg";
        var text = "";
        var resolt = SnapshotNoImage;;
        expect(scope.snapshot(text)).toBe(resolt);
        //textがnullの場合
        expect(scope.snapshot(text)).toBe(resolt);
        //スナップショットの中身があった場合それがそのまま戻る。
        text = 'test.png';
        resolt = text;
        expect(scope.snapshot(text)).toBe(resolt);
    }));
    //test scope.ThemeListに ThemeSettingThemeListの値を格納する
    it('setJson()', inject(function($controller) {
        scope.setJson();
        expect(scope.ThemeList).toBe(ThemeSettingThemeList);
        // ThemeSettingThemeListの内容を変更
        ThemeSettingThemeList = {};
        scope.setJson();
        expect(scope.ThemeList).toBe(ThemeSettingThemeList);
        //setJsonしなければ格納されていない。
        ThemeSettingThemeList = {"test":"jasmine"};
        expect(scope.ThemeList).toNotBe(ThemeSettingThemeList);

    }));


});