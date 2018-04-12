<?php

namespace Page;

class Base
{
    // include url of current page
    //public static $URL = '';

    /**
     * Declare UI map for this page here. CSS or XPath allowed.
     * public static $usernameField = '#username';
     * public static $formSubmitButton = "#mainForm input[type=submit]";
     */

    /**
     * Basic route example for your current URL
     * You can append any additional parameter to URL
     * and use it in tests like: Page\Edit::route('/123-post');
     */


    //Глобальные переменные
    /**
     * Главная страница WT и тестовых площадок
     */
    public static $urlMain = '';

    /**
     * Значение переменной поддомен
     */
    public static $subDomain = 'm.stage.site';

    /**
     * Главная страница для RU
     */
    public static $urlMainRu = 'http://www.vseinstrumenti.ru';

    /**
     * Главная страница для мобильной версии сайта RU
     */
    public static $urlMobileMainRu = 'http://m.vseinstrumenti.ru';

    /**
     * страница регистрации
     */
    public static $urlLogin = '/pcabinet/registration/';

    /**
     * страница регистрации для RU
     */
    public static $urlLoginRu = 'http://www.vseinstrumenti.ru/pcabinet/registration/';

    /**
     * страница корзины
     */
    public static $urlBasket = '/pcabinet/?block=myCart';

    /**
     * Url прямой ссылки для Очистки корзины в ЛК
     */
    public static $urlClearBasket = '/run/PCabinet/MyCart/clearCart';

    /**
     * Название/siteId для ввода в строку поиска
     */
    public static $searchGood = 'Перфоратор  HR 24';

    /**
     * значение поля "логин", вводимое в форму входа (ЛК)
     */
    public static $email = 'Avtotest@vi.vi';

    /**
     * значение поля "пароль", вводимое в форму входа (ЛК)
     */
    public static $password = '111111';

    /**
     * значение поля "Имя", вводимое в форму заявки на покупку товара (быстрый заказ)
     */
    public static $bidName = 'Тестов Тест Тестович';

    /**
     * значение поля "Телефон", вводимое в форму заявки на покупку товара (быстрый заказ)
     */
    public static $bidPhone = '9001111111';

    /**
     * значение поля "Улица" при заполнении адреса доставки Курьером
     */
    public static $streetName = 'Ленин';

    /**
     * значение поля "дом" при заполнении адреса доставки Курьером
     */
    public static $homeNumber = '1';

    /**
     * Id региона во всплывающем окне выбора региона (использую для задания НЕ франшизных регионов)
     */
    public static $regionId = '1';

    /**
     * Id региона во всплывающем окне выбора региона (использую для задания франшизных регионов)
     */
    public static $regionFranchiseId = '175';

    /**
     * значение поля "Область / республика / край" при заполнении адреса доставки ТрансКомпанией
     */
    public static $regionName = 'Владими';

    /**
     * значение поля "Населенный пункт" при заполнении адреса доставки ТрансКомпанией
     */
    public static $cityName = 'Ковро';

    /**
     * значение поля "Населенный пункт" при заполнении адреса доставки ТрансКомпанией
     */
    public static $OrderComment = 'ТЕСТОВЫЙ ЗАКАЗ!!!';


    /**
     * значение поля "Адрес доставки" при оформлении заказа, доставкой курьером на "Мобильной версии"
     */
    public static $adressCourierMobile = 'Проспект Ленина, д.1, кв.2';

    /**
     * выбор "Транспортной компании" (radiobutton) при заполнении адреса доставки ТрансКомпанией
     * id = tk5 - "Другая транспортная компания"
     */
    public static $transCompanyId = ['id' => 'tk5'];




    /**
     * @var AcceptanceTester
     */
    protected $tester;

    public function __construct(\AcceptanceTester $I)
    {
        $this->tester = $I;
    }


    /**
     * Нахождение и ожидание элемента через "implicitlyWait"
    */
/*    public function isElementPresent()
    {
        $I = $this->tester;
        webDriver->manage()->timeouts()->implicitlyWait(0);
        $I->boolean->result = webDriver->findElements()->size() > 0;
        $I->webDriver->manage()->timeouts()->implicitlyWait(30);
        return result;
    }
*/


    /**
     * Установка Куки выбора региона и вход в ЛК
     */
    public function loginAndRegionByCookie()
    {
        $I = $this->tester;
        $I->amOnPage('');
        $I->setCookie('vi_represent_id', '1');
        $I->setCookie('vi_represent_type', 'common');
        $I->setCookie('vi_descendant_id', '0');
        $I->setCookie('token', '8b0ce6b81c84392c9d69fd9319c631aca20ddf8f51641c9046f40d58da42e6ab30f1417d6b201d5f');
        $I->amOnPage(self::$urlClearBasket);
        $I->reloadPage();
    }
    
    /**
     * Вход на сайт и выбор региона (Москва по умолчанию)
     */
    public function enterSiteAndChooseRegion()
    {
        $I = $this->tester;
        $I->amOnPage(self::$urlMain);
        $I->waitForElement(['class' => 'region_check'], 50);
        //$I->waitForElement(['id' => 'popUpWindow1'], 30);//всплывающее окно выбора региона
        $I->wait(2);
        $I->click(['class' => 'showMoreRepresent']);
        $I->waitForElement(['class' => 'ui-autocomplete-input']);
        $I->click(['name' => self::$regionId]);
        //$I->wait(1);
        $I->waitForElement(['id' => 'what']);
    }

    /**
     * Вход на боевой сайт .ru и выбор региона (Москва по умолчанию)
     */
    public function enterSiteAndChooseRegionRu()
    {
        $I = $this->tester;
        $I->amOnUrl(self::$urlMainRu);
        $I->waitForElement(['class' => 'region_check'], 50);
        //$I->waitForElement(['id' => 'popUpWindow1'], 30);//всплывающее окно выбора региона
        $I->wait(2);
        $I->click(['name' => self::$regionId]);
        //$I->wait(1);
        $I->waitForElement(['id' => 'what']);
    }

    /**
     * Вход на сайт и выбор региона франшизы
     */
    public function enterSiteAndChooseFranchiseRegion()
    {
        $I = $this->tester;
        $I->amOnPage(self::$urlMain);
        $I->waitForElement(['class' => 'ui-autocomplete-input'], 30);
        //$I->waitForElement(['id' => 'popUpWindow1'], 30);//всплывающее окно выбора региона
        //$I->wait(1);
        $I->click(['name' => self::$regionFranchiseId]);
    }

    /**
     * Вход на боевой сайт .ru и выбор региона франшизы
     */
    public function enterSiteAndChooseFranchiseRegionRu()
    {
        $I = $this->tester;
        $I->amOnUrl(self::$urlMainRu);
        $I->waitForElement(['class' => 'ui-autocomplete-input'], 30);
        //$I->waitForElement(['id' => 'popUpWindow1'], 30);//всплывающее окно выбора региона
        //$I->wait(1);
        $I->click(['name' => self::$regionFranchiseId]);
    }

    /**
     * Вход в личный кабинет
     */
    public function login()
    {
        $I = $this->tester;
        //$I->amOnPage(self::$urlLogin);
        $I->click(['id' => 'cabinet_link']);
        $I->fillField(['id' => 'login-email'], self::$email);
        $I->fillField(['id' => 'login-password'], self::$password);
        $I->click(['id' => 'login-btn']);
    }

    /**
     * заполнение формы регистрации (Контактные данные) при покупке товара без регистрации, в итоге происходит вход в уже существующую учетку, а не создание новой учетки
     */
    public function newWayRegistration()
    {
        $I = $this->tester;
        //$I->amOnPage(self::$urlLogin);
        $I->fillField(['id' => 'step-reg-email'], self::$email);
        $I->click(['class' => 'submit-button']);
        $I->waitForElement(['id' => 'step-reg-password']);
        $I->fillField(['id' => 'step-reg-password'], self::$password);
        $I->waitForElement(['class' => 'js-login-button']);
        $I->click(['class' => 'js-login-button']);
    }

    /**
     * Принудительная очистка корзины по прямой ссылке
     */
    public function urlClearBasket()
    {
        $I = $this->tester;
        $I->reloadPage();
        $I->amOnPage(self::$urlClearBasket);
        $I->reloadPage();
        $I->amOnPage(self::$urlMain);
    }

    /**
     * Выбор первостоящей записи юридического лица в учетной записи
     */
    public function chooseJuristicUser()
    {
        $I = $this->tester;
        $I->wait(5);
        $I->click(['id' => 'cabinet_link']);
        $I->wait(5);
        if ($I->seeElement('//*[@id="header"]/div[3]/div/div/div[1]/p[2]/a/span'))
        {
            $I->click('//*[@id="header"]/div[3]/div/div/div[1]/p[2]/a/span');
        }
        else
        {
            $I->click('//*[@id="header"]/div[3]/div/div/div[1]/p[2]');
        }
    }


    /**
     * Покупка первого встречающегося товара из рубрики "Бензопилы"
     */
    public function buyGoodMain()
    {
        $I = $this->tester;
        //$I->amOnPage(self::$urlMain);
        $I->amOnPage('/sadovaya_tehnika/benzopily/');
        //$I->click(['class' => 'js_btn-buy-item-text']);

        $I->waitForElement(['class' => 'addItemToBasket'], 30);
        $I->wait(1);
        $I->click(['class' => 'addItemToBasket']);
        $I->wait(1);
        $I->waitForElement(['id' => 'popUpWindow1'], 30);
        $I->waitForElement(['class' => 'arrowWhiteRight'], 30);
        $I->click(['class' => 'arrowWhiteRight']);
    }

    /**
     * Использование главной поисковой строки на сайте, заполнение ее запросом и посредствои клика на кнопку "Лупа" - попадания на страницу "результатов поиска" по данному запросу
     */
    public function search()
    {
        $I = $this->tester;
        $I->fillField(['id' => 'what'], self::$searchGood);
        $I->click(['class' => 'searchSubmit']);
        $I->waitForElement(['class' => 'topListing']);
    }

    /**
     * Использование главной поисковой строки на сайте, заполнение ее запросом и посредствои Автокомплита - попадание в карточку товара
     */
    public function searchAutocomplete()
    {
        $I = $this->tester;
        $I->fillField(['id' => 'what'], self::$searchGood);
        $I->waitForElement('.ui-autocomplete');
        $I->wait(1); //ожидание отрисовки всего списка автокоплита
        $I->pressKey(['id' =>'what'], \WebDriverKeys::ARROW_DOWN);
        $I->pressKey(['id' =>'what'], \WebDriverKeys::ENTER);
        $I->waitForElement(['id' => 'tab1']);
    }

    /**
     * Задаем кол-во товара в корзине (Нажатием на "+")
     */
    public function quantGoodBasket()
    {
        $I = $this->tester;
        //$I->amOnPage(self::$urlBasket);
        $I->pressKey('.quant',array('ctrl','a'),'10');
    /*
        $I->click(['class' => 'cPlus']);
        $I->click(['class' => 'cPlus']);
        $I->click(['class' => 'cPlus']);
        $I->click(['class' => 'cPlus']);
        $I->click(['class' => 'cPlus']);
        $I->click(['class' => 'cPlus']);
        $I->click(['class' => 'cPlus']);
        $I->click(['class' => 'cPlus']);
    */
        $I->click(['class' => 'cPlus']);
    }

    /**
     * Начать оформление заказа - нажать кнопку "оформить заказ" из корзины
     */
    public function makeOrderStart()
    {
        $I = $this->tester;
        //$I->amOnPage(self::$urlBasket);
        //$I->click(['class' => '.basket']);
        $I->waitForElement(['link' => 'Оформить заказ']);
        $I->click(['link' => 'Оформить заказ']);
    }


    /**
     * Страница выбора контрагента (Выбор Физического лица)
     */
    public function OrderStep0Physic()
    {
        $I = $this->tester;
        $I->waitForElement('//*[@id="formStep"]/div/div[1]/dl/dd[1]/label');
        $I->checkOption('//*[@id="formStep"]/div/div[1]/dl/dd[1]/label'); //выбор первого радиобаттона
        $I->click(['class' => 'button-red']);
    }


    /**
     * Страница выбора контрагента на мобильной версии(Выбор Физического лица)
     */
    public function OrderMobileStep0Physic()
    {
        $I = $this->tester;
        $I->waitForElement(['class' => 'form_select']);
        $I->checkOption('//*[@class="form_select"]/option[1]');
    }

    /**
     * Страница выбора контрагента (Выбор Юридического лица)
     */
    public function OrderStep0Juristic()
    {
        $I = $this->tester;
        $I->waitForElement('#formStep');
        $I->checkOption('//*[@id="formStep"]/div/div[1]/dl/dd[2]/label'); //выбор второго радиобаттона/html/body/div[2]/div[2]/div/div/div/form/div/div[1]/dl/dt[2]
        $I->click(['class' => 'button-red']);
    }


    /**
     * Страница выбора контрагента на мобильной версии(Выбор юридического лица)
     */
    public function OrderMobileStep0Juristic()
    {
        $I = $this->tester;
        $I->waitForElement(['class' => 'form_select']);
        $I->checkOption('//*[@class="form_select"]/option[2]');
    }


    /**
     * Ожидание синхронизации WTIS по наличию товаров в магазинах
     */
    public function waitWtisSyncGoodInOffice()
    {
        $I = $this->tester;
        //$I->waitForElement('#step1-address-table [class="active"]', 120);
        $I->waitForElement(['class' => 'active'], 120);
        $I->wait(3);
    }

    /**
     * Первый шаг оформления заказа: Ожидание простановки "радиобаттона" (по умолчанию) и переход к следующему шагу
     */
    public function OrderStep1Self()
    {
        $I = $this->tester;
        //$I->checkOption(['class' => 'td_rd']);
        $I->checkOption(['class' => 'office']);
        $I->click(['class' => 'arrowWhiteRight']);
    }

    /**
     * Первый шаг оформления заказа: Ожидание загрузки наличия товаров из WTIS, переход на вкладку курьер и заполнение адреса
     */
    public function OrderStep1Courier()
    {
        $I = $this->tester;
        $I->click(['id' => 'ui-id-4']);
        $I->waitForElement(['id' => 'ui-id-5']);
        $I->click(['id' => 'ui-id-5']);
        $I->click(['class' => 'StepContentAdresAddI']);
        $I->waitForElement(['id' => 'street']);
        $I->wait(1);
        $I->fillField(['id' => 'street_tb'], self::$streetName);
        $I->waitForElement(['class' => 'ui-menu-item'], 50);
        $I->wait(2); //ожидание отрисовки всего списка автокоплита
        $I->click('//*[@class="boxForAutocompletePopUpStreets"]/ul/li[1]/a'); //выбор первого элемента из списка автокоплита
        $I->fillField(['id' => 'home'], self::$homeNumber);
        $I->click(['id' => 'step1submit']);
    }

    /**
     * Первый шаг оформления заказа: Ожидание загрузки наличия товаров из WTIS, переход на вкладку курьер и заполнение адреса
     */
    public function OrderStep1TransCompany()
    {
        $I = $this->tester;
        $I->click(['id' => 'ui-id-4']);
        $I->waitForElement(['id' => 'ui-id-6']);
        $I->click(['id' => 'ui-id-6']);
        $I->fillField(['name' => 'deliveryTransCompanySubject'], self::$regionName);
        $I->waitForElement (['class' => 'firstItem']);
        $I->wait(3); //ожидание отрисовки всего списка автокоплита
        //$I->pressKey(['id' =>'street_tb'], \WebDriverKeys::ARROW_DOWN);
        //$I->pressKey(['id' =>'street_tb'], \WebDriverKeys::ENTER);
        $I->click('//*[@class="boxForAutocompletePopUp"]/ul[2]/li/a'); //выбор первого элемента из списка автокоплита*/
        $I->fillField(['name' => 'deliveryTransCompanyCity'], self::$cityName);
        $I->waitForElement (['class' => 'firstItem']);
        $I->wait(3);
        $I->click('//*[@class="boxForAutocompletePopUp"]/ul[3]/li/a');
        $I->waitForElement(['id' => 'selectTkStep1']);
        //$I->wait(2);
        $I->pressKey(['id' =>'ui-id-6'], \WebDriverKeys::PAGE_DOWN);
        $I->wait(3);
        $I->click(self::$transCompanyId);
        $I->click(['id' => 'step1submit']);
    }

    /**
     * Второй шаг оформления заказа: Выбор способа оплаты - "Наличными" и переход к следующему шагу
     */
    public function OrderStep2Cash()
    {
        $I = $this->tester;
        $I->waitForElement(['id' => 'step2submit']);
        $I->checkOption(['id' => 'cash']);
        $I->waitForElement(['id' => 'step2submit']);
        $I->click(['id' => 'step2submit']);
    }


    /**
     * Второй шаг оформления заказа: Выбор способа оплаты - "Наличными" для юр.лиц и переход к следующему шагу
     */
    public function OrderStep2CashJuristic()
    {
        $I = $this->tester;
        $I->waitForElement(['id' => 'step2submit']);
        $I->checkOption(['id' => 'cash']);
        $I->waitForElement(['id' => 'step2submit']);
        $I->see('Вам будет выдан кассовый чек и полный комплект документов. Убедитесь, что данная форма оплаты принимается в вашей организации.');
        $I->click(['id' => 'step2submit']);
    }


    /**
     * Второй шаг оформления заказа: Выбор способа оплаты - "Банковской картой" для юр.лиц и переход к следующему шагу
     */
    public function OrderStep2CashByCard()
    {
        $I = $this->tester;
        $I->waitForElement(['id' => 'step2submit']);
        $I->checkOption(['id' => 'cash_by_card']);
        $I->waitForElement(['id' => 'step2submit']);
        $I->see('При оплате данным способом используйте банковскую карту, оформленную на');
        $I->click(['id' => 'step2submit']);
    }


    /**
     * Второй шаг оформления заказа: Выбор способа оплаты - "Электронным платежем" и переход к следующему шагу
     */
    public function OrderStep2Ecash()
    {
        $I = $this->tester;
        $I->waitForElement(['id' => 'step2submit']);
        $I->checkOption(['id' => 'ecash']);
        $I->waitForElement(['id' => 'step2submit']);
        $I->click(['id' => 'step2submit']);
    }


    /**
     * Второй шаг оформления заказа: Выбор способа оплаты - "Электронным платежем" для юр.лиц и переход к следующему шагу
     */
    public function OrderStep2EcashJuristic()
    {
        $I = $this->tester;
        $I->waitForElement(['id' => 'step2submit']);
        $I->checkOption(['id' => 'ecash']);
        $I->waitForElement(['id' => 'step2submit']);
        $I->see('При оплате данным способом используйте банковскую карту, оформленную на');
        $I->click(['id' => 'step2submit']);
    }



    /**
     * Второй шаг оформления заказа: Выбор способа оплаты - "Банковский или почтовый перевод" и переход к следующему шагу
     */
    public function OrderStep2Quittance()
    {
        $I = $this->tester;
        $I->waitForElement(['id' => 'step2submit'], 50);
        $I->checkOption(['id' => 'quittance']);
        $I->waitForElement(['id' => 'step2submit']);
        $I->click(['id' => 'step2submit']);
    }

    /**
     * Второй шаг оформления заказа: Выбор способа оплаты - "Оплата в кредит" и переход к следующему шагу
     */
    public function OrderStep2Credit()
    {
        $I = $this->tester;
        $I->waitForElement(['id' => 'step2submit']);
        $I->checkOption(['id' => 'credit']);
        $I->waitForElement(['id' => 'step2submit']);
        $I->click(['id' => 'step2submit']);
    }


    /**
     * Второй шаг оформления заказа: Выбор способа оплаты - "Оплата счета" для юр.лиц и переход к следующему шагу
     */
    public function OrderStep2Account()
    {
        $I = $this->tester;
        $I->waitForElement(['id' => 'step2submit']);
        $I->checkOption(['id' => 'account']);
        $I->waitForElement(['id' => 'step2submit']);
        $I->click(['id' => 'step2submit']);
    }

    /**
     * Третий шаг оформления заказа: Заполнение "Примечание к заказу" и подтверждение заказа
     */
    public function OrderStep3Accept()
    {
        $I = $this->tester;
        $I->waitForElement(['id' => 'step3submit']);
        $I->fillField(['name' => 'advancedInfo'], self::$OrderComment);//Заполнение поля "Примечание к заказу"
        $I->click(['id' => 'step3submit']);
    }

    /**
     * Третий шаг оформления заказа на РУ: Проверка страницы БЕЗ подтверждения заказа
     */
    public function OrderStep3NoAccept()
    {
        $I = $this->tester;
        $I->waitForElement(['id' => 'step3submit']);
        $I->see(self::$email);
        $I->seeElement(['id' => 'step3submit']);
    }

    /**
     * Переход с финального шага оформления заказа внуть заказа ("Просмотр заказа")
     */
    public function OrderStep4Final()
    {
        $I = $this->tester;
        $I->waitForElement(['link' => 'Посмотреть заказ'], 30);
        //$I->seeInCurrentUrl('?step4=true&orderId=');
        $I->click(['link' => 'Посмотреть заказ']);
    }

    /**
     * Удаление всех товаров из корзины
     */
    public function basketDeleteAll()//Удаление всех товаров из корзины
    {
        $I = $this->tester;
        $I->waitForElement(['class' => 'basketDeleteAllShowDialog']); // Удаление всех товаров из корзины
        $I->seeElement(['class' => 'basketDeleteAllShowDialog']);
        $I->click(['class' => 'basketDeleteAllShowDialog']);
        $I->waitForElement(['id' => 'popUpWindow1']);
        $I->click(['class' => 'basketDeleteAll']);
        //$I->waitForElement(['class' => 'emptyBasket']);
        $I->see('В корзине пока нет товаров. ');
    }



    //БЫСТРЫЙ ЗАКАЗ


    /**
     * Покупка первого встречающегося товара с главной страницы по кнопке "Купить" для быстрого заказа
     */
    public function buyGoodMainBid()
    {
        $I = $this->tester;
        $I->amOnPage(self::$urlMain);
        $I->click(['class' => 'catalogItemBuyA']);
    }

    /**
     * Начать оформление быстрого заказ - нажать кнопку "быстрый заказ" из корзины
     */
    public function makeOrderBidStart()
    {
        $I = $this->tester;
        //$I->amOnPage(self::$urlBasket);
        //$I->click(['class' => '.basket']);
        $I->click(['id' => 'buyInOneClick']);
    }

    /**
     * нажать кнопку "Отправить заказ" во всплывающем окне
     */
    public function sendOrderBidByLoginUser()
    {
        $I = $this->tester;
        //$I->amOnPage(self::$urlBasket);
        //$I->click(['class' => '.basket']);
        $I->waitForElement(['id' => 'popUpWindow1']);
        $I->see(self::$email);
        $I->click(['class' => 'makeOrderOneClick']);
        $I->waitForElement(['id' => 'popUpWindow2']);
        $I->seeElement(['id' => 'succ-one-click']);
    }

    /**
     * заполняем форму бустрого заказа для физического лица и нажимаем кнопку "Отправить заказ" во всплывающем окне
     */
    public function sendOrderBidPhysicWithoutLogin()
    {
        $I = $this->tester;
        //$I->amOnPage(self::$urlBasket);
        //$I->click(['class' => '.basket']);
        $I->waitForElement(['id' => 'popUpWindow1']);
        $I->fillField(['class' => 'one-click-fname'], self::$bidName);
        $I->fillField(['class' => 'one-click-phone'], self::$bidPhone);
        $I->click(['class' => 'makeOrderOneClick']);
        $I->waitForElement(['id' => 'popUpWindow2']);
        $I->seeElement(['id' => 'succ-one-click']);
    }


    /**
     * заполняем форму бустрого заказа для физического лица и нажимаем кнопку "Отправить заказ" во всплывающем окне
     */
    public function sendOrderBidPhysicWithoutLoginRu()
    {
        $I = $this->tester;
        //$I->amOnPage(self::$urlBasket);
        //$I->click(['class' => '.basket']);
        $I->waitForElement(['id' => 'popUpWindow1']);
        $I->fillField(['class' => 'one-click-fname'], self::$bidName);
        $I->fillField(['class' => 'one-click-phone'], self::$bidPhone);
        $I->seeElement(['class' => 'makeOrderOneClick']);
    }



    /**
     * заполняем форму бустрого заказа для юридического и нажимаем кнопку "Отправить заказ" во всплывающем окне
     */
    public function sendOrderBidJuristicWithoutLogin()
    {
        $I = $this->tester;
        //$I->amOnPage(self::$urlBasket);
        //$I->click(['class' => '.basket']);
        $I->waitForElement(['id' => 'popUpWindow1']);
        $I->fillField(['class' => 'one-click-fname'], self::$bidName);
        $I->fillField(['class' => 'one-click-phone'], self::$bidPhone);
        $I->checkOption(['name' => 'isJuristic']);
        $I->click(['class' => 'makeOrderOneClick']);
        $I->waitForElement(['id' => 'popUpWindow2']);
        $I->seeElement(['id' => 'succ-one-click']);
    }


    /**
     * заполняем форму бустрого заказа на РУ для юридического и видим кнопку "Отправить заказ" во всплывающем окне
     */
    public function sendOrderBidJuristicWithoutLoginRu()
    {
        $I = $this->tester;
        //$I->amOnPage(self::$urlBasket);
        //$I->click(['class' => '.basket']);
        $I->waitForElement(['id' => 'popUpWindow1']);
        $I->fillField(['class' => 'one-click-fname'], self::$bidName);
        $I->fillField(['class' => 'one-click-phone'], self::$bidPhone);
        $I->checkOption(['name' => 'isJuristic']);
        $I->seeElement(['class' => 'makeOrderOneClick']);
    }



    //ДЛЯ МОБИЛЬНОЙ ВЕРСИИ


    /**
     * Вход на "Мобильную версию сайта" и выбор региона(Москва по умолчанию)
     */
    public function enterMobileSiteAndChooseRegion()
    {
        $I = $this->tester;
        $I->amOnSubdomain(self::$subDomain);
        $I->amOnPage(self::$urlMain);
        $I->waitForElement(['id' => 'region_modal']);
        //$I->click(['id' => 'region_modal']);
        //$I->selectOption(['class' => 'otherCitySelect'], self::$regionId);
    }

    /**
     * Вход на "Мобильную версию сайта" на РУ и выбор региона(Москва по умолчанию)
     */
    public function enterMobileSiteAndChooseRegionRu()
    {
        $I = $this->tester;
        $I->amOnUrl(self::$urlMobileMainRu);

        $I->waitForElement(['id' => 'mobile-menu-show']);
        $I->click(['id' => 'mobile-menu-show']);
        $I->waitForElement(['class' => 'menu_city']);
        $I->selectOption(['class' => 'menu_city'], self::$regionId);

    }



    /**
     * Вход на "Мобильную версию сайта" и выбор региона франшизы
     */
    public function enterMobileSiteAndChooseFranchiseRegion()
    {
        $I = $this->tester;
        //$I->amOnPage(self::$urlLogin);
        $I->amOnSubdomain('m');
        $I->amOnPage(self::$urlMain);
        $I->waitForElement(['id' => 'region_modal']);
        $I->click(['id' => 'region_modal']);
        $I->selectOption(['class' => 'otherCitySelect'], self::$regionFranchiseId);
    }

    /**
     * Вход в личный кабинет "Мобильной версии сайта"
     */
    public function loginMobile()
    {
        $I = $this->tester;
        //$I->amOnPage(self::$urlLogin);
        $I->waitForElement(['class' => 'btn-pcab']);
        $I->click(['class' => 'btn-pcab']);
        $I->fillField(['id' => 'userEmail'], self::$email);
        $I->fillField(['id' => 'userPassword'], self::$password);
        $I->click(['class' => 'btn']);
    }

    /**
     * Покупка первого встречающегося товара в листинге
     */
    public function buyGoodMobile()
    {
        $I = $this->tester;
        //$I->amOnSubdomain(self::$subDomain);
        //$I->amOnPage(self::$urlMain);
        $I->waitForElement(['class' => 'category-grid_cell']);
        $I->click(['class' => 'category-grid_cell']);//переход в листинг первой попавшейся рубрики
        $I->waitForElement(['class' => 'btn-buy-item']);
        $I->click(['class' => 'btn-buy-item']);//покупка первого попавшегося товара
        $I->waitForElement(['class' => 'btn-to-cart']);
        $I->click(['class' => 'btn-to-cart']);
    }

    /**
     * Задаем кол-во товара в корзине на мобильной версии (Вставляем значение в поле кол-во и нажимаем на "+")
     */
    public function quantGoodBasketMobile()
    {
        $I = $this->tester;
        //$I->amOnPage(self::$urlBasket);
        $I->pressKey('.input-number','1');
        $I->click(['class' => 'plus']);
    }

    /**
     * Начать оформление заказа - нажать кнопку "оформить заказ" из корзины на Мобильной версии
     */
    public function makeOrderMobileStart()
    {
        $I = $this->tester;
        //$I->amOnPage(self::$urlBasket);
        //$I->click(['class' => '.basket']);
        $I->click(['id' => 'makeOrder']);
    }

    /**
     * Выбор "Самовывоз" в способе получения при оформлении заказа(на Мобильной версии)
     */
    public function OrderMobileSelf()
    {
        $I = $this->tester;
        $I->selectOption(['id' => 'transType'], 'self');
        $I->waitForElement(['id' => 'office']);
    }

    /**
     * Выбор "Курьером" в способе получения при оформлении заказа(на Мобильной версии)
     */
    public function OrderMobileCourier()
    {
        $I = $this->tester;
        $I->selectOption(['id' => 'transType'], 'courier');
        $I->waitForElement(['id' => 'address']);
        $I->fillField(['id' => 'address'], self::$adressCourierMobile);
    }

    /**
     * Выбор "Транспортной компанией" в способе получения при оформлении заказа(на Мобильной версии)
     */
    public function OrderMobileTransCompany()
    {
        $I = $this->tester;
        $I->selectOption(['id' => 'transType'], 'transCompany');
        $I->waitForElement(['id' => 'address']);
        $I->fillField(['id' => 'address'], self::$adressCourierMobile);
    }

    /**
     * Выбор "Оплата наличными" в способе оплаты при оформлении заказа(на Мобильной версии)
     */
    public function OrderMobileCash()
    {
        $I = $this->tester;
        $I->waitForElement(['id' => 'paymentMode']);
        $I->selectOption(['id' => 'paymentMode'], 'cash');
    }


    /**
     * Выбор способа оплаты - "Банковской картой" для юр.лиц (на Мобильной версии)
     */
    public function OrderMobileCashByCard()
    {
        $I = $this->tester;
        $I->waitForElement(['id' => 'paymentMode']);
        $I->selectOption(['id' => 'paymentMode'], 'cash_by_card');
    }


    /**
     * Выбор "Электронные способы оплаты" в способе оплаты при оформлении заказа(на Мобильной версии)
     */
    public function OrderMobileEcash()
    {
        $I = $this->tester;
        $I->selectOption(['id' => 'paymentMode'], 'ecash');
    }

    /**
     * Выбор "Банковский или почтовый перевод" в способе оплаты при оформлении заказа(на Мобильной версии)
     */
    public function OrderMobileQuittance()
    {
        $I = $this->tester;
        $I->selectOption(['id' => 'paymentMode'], 'quittance');
    }


    /**
     * Выбор "Оплата счета" в способе оплаты при оформлении заказа(на Мобильной версии)
     */
    public function OrderMobileAccount()
    {
        $I = $this->tester;
        $I->selectOption(['id' => 'paymentMode'], 'account');
    }


    /**
     * Выбор "Оплата в кредит" в способе оплаты при оформлении заказа(на Мобильной версии)
     */
    public function OrderMobileCredit()
    {
        $I = $this->tester;
        $I->selectOption(['id' => 'paymentMode'], 'credit');
    }


    /**
     * Заполнение поля "Примечание к заказу" при оформлении заказа(на Мобильной версии)
     */
    public function OrderMobileComment()
    {
        $I = $this->tester;
        $I->fillField(['id' => 'advancedInfo'], self::$OrderComment);
    }


    /**
     * Заполнение "Примечание к заказу" и подтверждение заказа
     */
    public function OrderMobileAccept()
    {
        $I = $this->tester;
        $I->click(['class' => 'btn']);
        $I->waitForElement(['class' => 'notify-success']);
        $I->seeElement(['class' => 'notify-success']);
        $I->seeInCurrentUrl('/orderConfirm/?orderId=');
        $I->see('Ваш заказ отправлен менеджеру');
        $I->dontSee('0000-000000-00000');
        $I->dontSee('0000-0MMM00-00000');
        $I->see('MMM');
    }



    /*public static function route($param)
        {
            return static::$URL.$param;
        }

    */
}

