<?php

namespace RandData\Set\ru_RU;

/**
 * Russian name dataset
 */
class Person extends \RandData\Set\en_GB\Person
{

    /**
     * Class constructor
     */
    public function __construct()
    {
        parent::__construct();
        $this->setFormat("%l %f %m");
    }

    /**
     * @inherit
     */
    public function get()
    {
        $sex = $this->sex;

        if (!$this->sex) {
            $sexGenerator = mt_rand(1, 100);
            $sex = $sexGenerator > 50 ? self::SEX_FEMALE : self::SEX_MALE;
        }

        $nameLast = $this->getLastName($sex);
        $nameFirst = $this->getFirstName($sex);
        $nameMiddle = $this->getMiddleName($sex);

        $subst = [
            "%l1" => mb_substr($nameLast, 0, 1),
            "%l" => $nameLast,
            "%f1" => mb_substr($nameFirst, 0, 1),
            "%f" => $nameFirst,
            "%m1" => mb_substr($nameMiddle, 0, 1),
            "%m" => $nameMiddle
        ];

        return str_replace(array_keys($subst), array_values($subst), $this->format);
    }

    /**
     * Returns person's last name
     * @param string $sex Sex of the last name. m - Male, f - female
     * @return string Random last name
     */
    public function getLastName($sex = null)
    {
//        $arr = $sex == self::SEX_MALE ? $this->getLastNameMale() : $this->getLastNameFemale();
//        return $arr[array_rand($arr)];

        $reader = new \RandData\CsvReader();
        return $reader->get(__DIR__ . "/data/last_name_male.csv");
    }

    /**
     * Returns list of female last name
     * @return array List of female last name
     */
    public function getLastNameFemale()
    {
        $reader = new \RandData\CsvReader();
        return $reader->get(__DIR__ . "/data/last_name_female.csv");
    }

    /**
     * Returns list of female first name
     * @return array List of female first name
     */
    public function getFirstNameFemale()
    {
        $reader = new \RandData\CsvReader();
        return $reader->get(__DIR__ . "/data/first_name_female.csv");
    }

    /**
     * Returns list of male first name
     * @return array List of male first name
     */
    public function getFirstNameMale()
    {
        return [
            'Абдурахмангаджи','Александр','Адам','Адольф','Аким','Аксён','Алекс','Алексей','Алим','Альберт','Альфред',
            'Анастас','Анатолий','Андрей','Андриян','Андроник','Антон','Аполлон','Аркадий','Арнольд','Арсен',
            'Арсений','Артём','Артемий','Артур','Афанасий','Богдан','Борис','Борислав','Вадим','Валентин','Валерий',
            'Валерьян','Варлам','Варсонофий','Василий','Вениамин','Викентий','Виктор','Вильгельм','Виссарион',
            'Виталий','Владимир','Владислав','Владлен','Влас','Властислав','Всеволод','Вячеслав','Гавриил','Геннадий',
            'Генрих','Георгий','Геральд','Герасим','Герман','Гермоген','Геронтий','Глеб','Гордей','Григорий','Густав',
            'Давид','Дан','Даниил','Демид','Демьян','Денис','Дмитрий','Донат','Евгений','Егор','Елисей','Ерофей',
            'Ефим','Ефрем','Захар','Иван','Игнат','Игорь','Измаил','Илларион','Илья','Иннокентий','Иосиф','Ираклий',
            'Капитон','Карл','Кир','Кирилл','Кирсан','Клим','Кондратий','Константин','Корней','Кристиан','Лаврентий',
            'Лазарь','Лев','Леон','Леонид','Леонтий','Лин','Лука','Любим','Любомир','Макар','Максим','Марат','Марк',
            'Мартин','Матвей','Милан','Мирон','Мирослав','Михаил','Моисей','Мстислав','Назар','Натан','Нестор',
            'Никита','Никодим','Николай','Олег','Орест','Остап','Павел','Пётр','Платон','Полиен','Прокопий','Радислав',
            'Радмир','Радослав','Ратмир','Рауль','Рафаил','Ринат','Роберт','Родион','Роланд','Роман','Ростислав',
            'Рубен','Рудольф','Руслан','Савва','Савелий','Самсон','Светозар','Святослав','Севастиан','Северин',
            'Семён','Серафим','Сергей','Симон','Спартак','Станислав','Степан','Тарас','Тимофей','Тимур','Тихон',
            'Фёдор','Феликс','Фидель','Филипп','Франц','Фрол','Христофор','Эдгар','Эдуард','Эмиль','Эрик','Эрнест',
            'Юлиан','Юлий','Юрий','Яков','Ян','Яромир','Ярослав'
        ];
    }

    /**
     * Returns list of female middle names
     * @return array list of female middle names
     */
    public function getMiddleNameFemale()
    {
        return [
            'Александровна','Алексеевна','Анатольевна','Андреевна','Антоновна','Аркадьевна','Артемовна','Богдановна',
            'Борисовна','Валентиновна','Валерьевна','Васильевна','Викторовна','Виталиевна','Владимировна',
            'Владиславовна','Вячеславовна','Геннадиевна','Георгиевна','Григорьевна','Даниловна','Денисовна',
            'Дмитриевна','Евгеньевна','Егоровна','Ефимовна','Ивановна','Игоревна','Ильинична','Иосифовна',
            'Кирилловна','Константиновна','Леонидовна','Львовна','Максимовна','Матвеевна','Михайловна',
            'Николаевна','Олеговна'
        ];
    }

    /**
     * Returns list of male middle names
     * @return array List of male middle names
     */
    public function getMiddleNameMale()
    {
        return [
            'Александрович','Алексеевич','Анатольевич','Андреевич','Антонович','Аркадьевич','Артемович','Бедросович',
            'Богданович','Борисович','Валентинович','Валерьевич','Васильевич','Викторович','Витальевич','Владимирович',
            'Владиславович','Вольфович','Вячеславович','Геннадиевич','Георгиевич','Григорьевич','Данилович',
            'Денисович','Дмитриевич','Евгеньевич','Егорович','Ефимович','Иванович','Иваныч','Игнатьевич','Игоревич',
            'Ильич','Иосифович','Исаакович','Кириллович','Константинович','Леонидович','Львович','Максимович',
            'Матвеевич','Михайлович','Николаевич','Олегович','Павлович','Палыч','Петрович','Платонович','Робертович',
            'Романович','Саныч','Северинович','Семенович','Сергеевич','Станиславович','Степанович','Тарасович',
            'Тимофеевич','Федорович','Феликсович','Филиппович','Эдуардович','Юрьевич','Яковлевич','Ярославович'
        ];
    }

    /**
     * Returns list of male last names
     * @return array List of male last names
     */
    public function getLastNameMale()
    {
        $reader = new \RandData\CsvReader();
        return $reader->get(__DIR__ . "/data/last_name_male.csv");
    }
}
