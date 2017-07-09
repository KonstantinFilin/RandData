<?php

namespace RandData\Set\ru_RU;

/**
 * Russian city dataset
 */
class City extends \RandData\Set
{
    /**
     * @inherit
     */
    public function get()
    {
        $cityList = $this->getList();
        return $cityList[array_rand($cityList)];
    }

    /**
     * @inherit
     */
    public function init($params = [])
    {
        
    }

    /**
     * Returns city list
     * @return array City list
     */
    protected function getList()
    {
        return [
            'Москва', 'Санкт-Петербург', 'Новосибирск', 'Екатеринбург', 'Нижний Новгород', 'Казань', 'Челябинск', 'Омск', 'Самара', 'Ростов-на-Дону',
            'Уфа', 'Красноярск', 'Пермь', 'Воронеж', 'Волгоград', 'Краснодар', 'Саратов', 'Тюмень', 'Тольятти', 'Ижевск',
            'Барнаул', 'Ульяновск', 'Иркутск', 'Хабаровск', 'Ярославль', 'Владивосток', 'Махачкала', 'Томск', 'Оренбург', 'Кемерово',
            'Новокузнецк', 'Рязань', 'Астрахань', 'Набережные Челны', 'Пенза', 'Липецк', 'Киров', 'Чебоксары', 'Тула', 'Калининград',
            'Балашиха', 'Курск', 'Улан-Удэ', 'Ставрополь', 'Севастополь', 'Тверь', 'Магнитогорск', 'Сочи', 'Иваново', 'Брянск',
            'Белгород', 'Сургут', 'Нижний Тагил', 'Владимир', 'Архангельск', 'Чита', 'Калуга', 'Симферополь', 'Смоленск', 'Волжский',
            'Курган', 'Орёл', 'Череповец', 'Вологда', 'Саранск', 'Владикавказ', 'Якутск', 'Мурманск', 'Подольск', 'Тамбов',
            'Грозный', 'Стерлитамак', 'Петрозаводск', 'Кострома', 'Нижневартовск', 'Новороссийск', 'Йошкар-Ола', 'Таганрог', 'Комсомольск-на-Амуре', 'Сыктывкар',
            'Химки', 'Нальчик', 'Шахты', 'Нижнекамск', 'Братск', 'Дзержинск', 'Орск', 'Ангарск', 'Благовещенск', 'Энгельс',
            'Старый Оскол', 'Великий Новгород', 'Королёв', 'Псков', 'Мытищи', 'Бийск', 'Люберцы', 'Прокопьевск', 'Южно-Сахалинск', 'Балаково'
        ];
    }
}
