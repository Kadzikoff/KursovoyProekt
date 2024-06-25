<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>СпортГид</title>
  <script src="script.js"></script>
  
  <link rel="stylesheet" href="style.css">
  
  <script src="dist/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="dist/css/bootstrap.min.css">
  
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&display=swap" rel="stylesheet" />
  <?php
try {
    $db = new PDO('mysql:host=localhost;dbname=u2709968_SportComplex; charset=utf8', 'u2709968_Admin', '545432481373qwe');
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    $info = [];
    $city = [];

    // Подготовленный запрос с использованием корректной кодировки
    $query = $db->prepare("SELECT * FROM `организация` JOIN `спортивные_сооружения` ON `ID_Организации` = `ID_Сооружения`");
    $query->execute();
    $info = $query->fetchAll(PDO::FETCH_ASSOC);

    // Запрос для таблицы "город"
    $query = $db->query('SELECT * FROM город');
    $city = $query->fetchAll(PDO::FETCH_ASSOC);
    
} catch (PDOException $e) {
    echo 'Connection failed: ' . $e->getMessage();
}
  ?>
</head>
<!-- Modal auth -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title fs-4" id="exampleModalLabel">Авторизация</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="BodyButton">
        <Button class="ButtonGuest"><a class="ButtonGuestA" href="Admin_User_Panel/user.php">Войти как пользователь</a></Button>
        <Button class="ButtonGuest"><a class="ButtonGuestA" href="Admin_User_Panel/admin.php">Войти как администратор</a></Button>
      </div>
    </div>
  </div>
</div>
<body>
  <div class="Landing">
    <div class="MainNavBar">
      <div class="NavBarWrapper">
        <div class="NavBar">
          <div class="Logo">
            <a class="SportGuide" href="#">
              <span class="SportTitle">Спорт</span>
              <span class="GuideTitle">Гид</span>
            </a>
          </div>
          <div class="NavBarBlock">
            <a class="NavBarText" href="#">Главная</a>
            <a class="NavBarText" href="#ContainerSearch">Спортивные сооружения</a>
            <a class="NavBarText" href="#footer">Контакты</a>
            <a type="button" class="NavBarText" data-bs-toggle="modal" data-bs-target="#exampleModal">Авторизация</a>
          </div>
        </div>
      </div>
      <div class="MainContentHeader">
        <div class="MainContentTitle">
          <p class="SportGuideTitle">СпортГид</p>
          <p class="SportGuideSubtitle">
            ваш надежный помощник в поиске и выборе спортивных объектов!
          </p>
        </div>
      </div>
      <button>
        <a href="#ResultBlocks"><img class="ArrowDownBtn" src="img/icons8-arrow-down-100 2.png" alt="" href="#" /></a>
      </button>
    </div>
    <div class="MainContainer">
      <div class="ContainerSearch" id="ContainerSearch">
        <p class="SearchTitle">
          Найди свой идеальный спортивный комплекс прямо здесь
        </p>
        <div class="BlockSearch">
        <input type="text" id="search" placeholder="Поиск" class="SearchBlock">
        </div>
        <div class="MainListWrapper">
          <div class="MainList">
            <div class="SideBarFilter">
              <form id="filterForm" class="Filter">
                <select id="activityType" class="FilterBlock">
                  <option selected>Вид деятельности</option>
                  <?php foreach ($info as $index => $data): ?>
                    <option value="<?php echo $data['Вид_деятельности']; ?>"><?php echo $data['Вид_деятельности']; ?></option>
                  <?php endforeach; ?>
                </select>
                <input type="text" id="area" placeholder="Введите площадь" class="FilterBlock">
                <input type="text" id="capacity" placeholder="Введите вместительность" class="FilterBlock">
                <select id="city" class="FilterBlock">
                  <option selected>Город</option>
                  <?php foreach ($city as $index => $data): ?>
                    <option value="<?php echo $data['Название_Городов']; ?>"><?php echo $data['Название_Городов']; ?></option>
                  <?php endforeach; ?>
                </select>
                <button type="button" class="ButtonConfirm" onclick="applyFilters()">Применить</button>
              </form>
            </div>
            <div class="ResultBlocks" id="ResultBlocks">
              <?php foreach ($info as $index => $data): ?>
                <div class="ResultBlock">
                  <div class="ResultHeadText">
                    <div class="WidgetHeader">
                      <span class="WidgetHeaderTitle"><?php echo $data['Название']; ?></span>
                      <span class="WidgetHeaderMeta"><?php echo $data['Вид_деятельности']; ?></span>
                      <span class="WidgetHeaderLocation"><?php echo $data['Город'] . ' ' . $data['Адрес']; ?></span>
                    </div>
                    <div class="WidgetSpec">
                      <?php if (!empty($data['Телефон_Организации'])): ?>
                        <div class="Spec">
                          <span class="SpecIndex">Телефон</span>
                          <a href="tel:<?php echo $data['Телефон_Организации']; ?>" class="SpecValue"><?php echo $data['Телефон_Организации']; ?></a>
                        </div>
                      <?php endif; ?>
                      <?php if (!empty($data['График_работы'])): ?>
                        <div class="Spec">
                          <span class="SpecIndex">Режим работы</span>
                          <span class="SpecValue"><?php echo $data['График_работы']; ?></span>
                        </div>
                      <?php endif; ?>
                      <?php if (!empty($data['Сайт_Организации'])): ?>
                        <div class="Spec">
                          <span class="SpecIndex">Сайт</span>
                          <a href="<?php echo $data['Сайт_Организации']; ?>" target="_blank" class="SpecValue"><?php echo $data['Сайт_Организации']; ?></a>
                        </div>
                      <?php endif; ?>
                    </div>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#<?php echo $index; ?>">
                      Подробнее
                    </button>
                    
                    <div class="modal fade" id="<?php echo $index; ?>" tabindex="100" aria-labelledby="exampleModalLabel" aria-hidden="false">
                      <div class="modal-dialog modal-dialog-scrollable">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h1 class="modal-title fs-4" id="exampleModalLabel"><?php echo $data['Название']; ?></h1>
                            <h2 class="modal-title fs-3" id="exampleModalLabel"><?php echo $data['Вид_деятельности']; ?></h2>
                          </div>
                          <div class="modal-body">
                            <div class="InfoSport">
                              <h2 class="modal-title fs-2" id="exampleModalLabel">Информация о спортивном сооружение</h2>
                              <hr style="width: 100%; border-top: 4px solid black; margin-top: 2px; margin-bottom: 2px;">
                              <div class="Spec">
                                <span class="SpecIndex">Адрес</span>
                                <a href="<?php echo $data['Ссылка_Адрес']; ?>" target="_blank" class="SpecValue"><?php echo $data['Город'] . ' ' . $data['Адрес']; ?></a>
                              </div>
                              <?php if (!empty($data['Телефон_Организации'])): ?>
                                <div class="Spec">
                                  <span class="SpecIndex">Телефон</span>
                                  <a href="tel:<?php echo $data['Телефон_Организации']; ?>" class="SpecValue"><?php echo $data['Телефон_Организации']; ?></a>
                                </div>
                              <?php endif; ?>
                              <?php if (!empty($data['График_работы'])): ?>
                                <div class="Spec">
                                  <span class="SpecIndex">Режим работы</span>
                                  <span class="SpecValue"><?php echo $data['График_работы']; ?></span>
                                </div>
                              <?php endif; ?>
                              <?php if (!empty($data['Сайт_Организации'])): ?>
                                <div class="Spec">
                                  <span class="SpecIndex">Сайт</span>
                                  <a href="<?php echo $data['Сайт_Организации']; ?>" target="_blank" class="SpecValue"><?php echo $data['Сайт_Организации']; ?></a>
                                </div>
                              <?php endif; ?>
                              
                              <?php if (!empty($data['Площадь'])): ?>
                              <div class="Spec">
                                <span class="SpecIndex">Площадь</span>
                                <span class="SpecValue"><?php echo $data['Площадь']; ?>м²</span>
                              </div>
                              <?php endif; ?>
                              
                              <?php if (!empty($data['Вместительность'])): ?>
                              <div class="Spec">
                                <span class="SpecIndex">Вместительность</span>
                                <span class="SpecValue"><?php echo $data['Вместительность']; ?> чел.</span>
                              </div>
                              <?php endif; ?>
                            </div>
                            
                            
                            
                            <div class="InfoOrganization">
                              <h2 class="modal-title fs-2" id="exampleModalLabel">Информация об организации</h2>
                              <hr style="width: 100%; border-top: 4px solid black; margin-top: 2px; margin-bottom: 2px;">
                              
                              <?php if (!empty($data['Название_Организации'])): ?>
                                <div class="Spec">
                                  <span class="SpecIndex">Наименование организации</span>
                                  <span class="SpecValue"><?php echo $data['Название_Организации']; ?></span>
                                </div>
                              <?php endif; ?>

                              <div class="Spec">
                                <span class="SpecIndex">Адрес</span>
                                <a href="<?php echo $data['Ссылка_Адрес']; ?>" target="_blank" class="SpecValue"><?php echo $data['Город'] . ' ' . $data['Адрес']; ?></a>
                              </div>                       
                              <?php if (!empty($data['Телефон_Организации'])): ?>
                              <div class="Spec">
                                <span class="SpecIndex">Телефон</span>
                                <a href="tel:<?php echo $data['Телефон_Организации']; ?>" class="SpecValue"><?php echo $data['Телефон_Организации']; ?></a>
                              </div>
                              <?php endif; ?>
                              
                              <?php if (!empty($data['Почта_Организации'])): ?>
                              <div class="Spec">
                                <span class="SpecIndex">Почта</span>
                                <a href="mailto:<?php echo $data['Почта_Организации']; ?>" class="SpecValue"><?php echo $data['Почта_Организации']; ?></a>
                              </div>
                              <?php endif; ?>
                              <?php if (!empty($data['Сайт_Организации'])): ?>
                              <div class="Spec">
                               <span class="SpecIndex">Сайт</span>
                               <a href="<?php echo $data['Сайт_Организации']; ?>" target="_blank"
                                 class="SpecValue"><?php echo $data['Сайт_Организации']; ?></a>
                              </div>
      
                              <?php endif; ?>
                            </div>
                            
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Закрыть</button>
                          </div>
                        </div>
                      </div>
                    </div>

                  </div>
                </div>
              <?php endforeach; ?>
            </div>
          </div>
        </div>
      </div>
    </div>
      <div class="Footer" id="footer">
        <div class="FooterContent">
          <div class="FooterLogo">
              <a class="FooterTitle">
              <span class="FooterText">Курсовой проект</span>
            </a>
            <a class="FooterTitle">
              <span class="FooterText">СпортГид</span>
              <span class="FooterText">2024год</span>
            </a>
          </div>
          <div class="FooterList">
            <a class="FooterLink" href="#">Главная</a>
            <a class="FooterLink" href="#">Спортивные сооружения</a>
          </div>
          <div class="FooterList">
            <a class="FooterLink" href="mailto:dima.krut999@mail.ru" target="blank">Почта</a>
            <a class="FooterLink" href="https://t.me/Kadz1k" target="blank">Telegram</a>
          </div>
        </div>
      </div>
  </div>
</body>

</html>
