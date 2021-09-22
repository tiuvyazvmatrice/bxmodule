# bxmodule

##Модуль копирует компонент, а так-же в публичной части создает раздел /grouplist/
##в котором производит вызов компонента

<$APPLICATION->IncludeComponent(
"company:usergroups.list",
".default",
[
"COMPONENT_TEMPLATE" => ".default",
"CACHE_TYPE" => "A",
"CACHE_TIME" => "36000000"
],
false
);>