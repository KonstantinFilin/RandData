<?php

namespace RandData\Set\en_GB;

/**
 * Russian name dataset
 */
class Person extends \RandData\Set
{
    // Male constant
    const SEX_MALE = "m";
    
    // Female constant
    const SEX_FEMALE = "f";
    
    // Sex to generate. If missed, will be random generated
    protected $sex;
    
    // Output format
    protected $format;
    
    /**
     * Class constructor
     */
    function __construct() 
    {
        $this->sex = null;
        $this->format = "%f %m %l";
    }

    /**
     * Return person sex
     * @return string m - Male, f - Female
     */
    public function getSex() {
        return $this->sex;
    }

    /**
     * Sets person sex
     * @param string $sex m - Male, f - Female
     */
    public function setSex($sex) {
        if (in_array($sex, [ self::SEX_MALE, self::SEX_FEMALE ])) {
            $this->sex = $sex;
        } else {
            $this->sex = null;
        }
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
        
        $nameLast = $this->getLastName();
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
     * @inherit
     */
    public function init($params = []) 
    {
        if (!empty($params["sex"])) {
            $this->setSex($params["sex"]);
        }
        
        if (!empty($params["format"])) {
            $this->setFormat($params["format"]);
        }
    }
    
    /**
     * Returns person's last name
     * @return string Random last name
     */
    public function getLastName() 
    {
        $arr = [
            'Adams', 'Alexander', 'Allen', 'Alvarez', 'Anderson', 'Andrews', 'Armstrong', 'Arnold', 'Austin', 'Bailey',
            'Baker', 'Banks', 'Barnes', 'Barnett', 'Barrett', 'Bates', 'Beck', 'Bell', 'Bennett', 'Berry',
            'Bishop', 'Black', 'Bowman', 'Boyd', 'Bradley', 'Brewer', 'Brooks', 'Brown', 'Bryant', 'Burke',
            'Burns', 'Burton', 'Butler', 'Byrd', 'Caldwell', 'Campbell', 'Carlson', 'Carpenter', 'Carr', 'Carroll',
            'Carter', 'Castillo', 'Castro', 'Chambers', 'Chapman', 'Chavez', 'Clark', 'Cole', 'Coleman', 'Collins',
            'Cook', 'Cooper', 'Cox', 'Craig', 'Crawford', 'Cruz', 'Cunningham', 'Curtis', 'Daniels', 'Davidson',
            'Davis', 'Day', 'Dean', 'Diaz', 'Dixon', 'Douglas', 'Duncan', 'Dunn', 'Edwards', 'Elliott',
            'Ellis', 'Evans', 'Ferguson', 'Fernandez', 'Fields', 'Fisher', 'Fleming', 'Fletcher', 'Flores', 'Ford',
            'Foster', 'Fowler', 'Fox', 'Franklin', 'Frazier', 'Freeman', 'Fuller', 'Garcia', 'Gardner', 'Garrett',
            'Garza', 'George', 'Gibson', 'Gilbert', 'Gomez', 'Gonzales', 'Gonzalez', 'Gordon', 'Graham', 'Grant',
            'Graves', 'Gray', 'Green', 'Greene', 'Gregory', 'Griffin', 'Gutierrez', 'Hale', 'Hall', 'Hamilton',
            'Hansen', 'Hanson', 'Harper', 'Harris', 'Harrison', 'Hart', 'Harvey', 'Hawkins', 'Hayes', 'Henderson',
            'Henry', 'Hernandez', 'Herrera', 'Hicks', 'Hill', 'Hoffman', 'Holland', 'Holmes', 'Holt', 'Hopkins',
            'Horton', 'Howard', 'Howell', 'Hudson', 'Hughes', 'Hunt', 'Hunter', 'Jackson', 'Jacobs', 'James',
            'Jenkins', 'Jennings', 'Jensen', 'Jimenez', 'Johnson', 'Johnston', 'Jones', 'Jordan', 'Kelley', 'Kelly',
            'Kennedy', 'Kim', 'King', 'Knight', 'Lambert', 'Lane', 'Larson', 'Lawrence', 'Lawson', 'Lee',
            'Lewis', 'Little', 'Long', 'Lopez', 'Lowe', 'Lucas', 'Lynch', 'Marshall', 'Martin', 'Martinez',
            'Mason', 'Matthews', 'May', 'Mccoy', 'Mcdonald', 'Mckinney', 'Medina', 'Mendoza', 'Meyer', 'Miles',
            'Miller', 'Mills', 'Mitchell', 'Montgomery', 'Moore', 'Morales', 'Moreno', 'Morgan', 'Morris', 'Morrison',
            'Murphy', 'Murray', 'Myers', 'Neal', 'Nelson', 'Newman', 'Nguyen', 'Nichols', 'O\'brien', 'Oliver',
            'Olson', 'Ortiz', 'Owens', 'Palmer', 'Parker', 'Patterson', 'Payne', 'Pearson', 'Pena', 'Perez',
            'Perkins', 'Perry', 'Peters', 'Peterson', 'Phillips', 'Pierce', 'Porter', 'Powell', 'Price', 'Ramirez',
            'Ramos', 'Ray', 'Reed', 'Reid', 'Reyes', 'Reynolds', 'Rhodes', 'Rice', 'Richards', 'Richardson',
            'Riley', 'Rivera', 'Roberts', 'Robertson', 'Robinson', 'Rodriguez', 'Rodriquez', 'Rogers', 'Romero', 'Rose',
            'Ross', 'Ruiz', 'Russell', 'Ryan', 'Sanchez', 'Sanders', 'Schmidt', 'Scott', 'Shaw', 'Shelton',
            'Silva', 'Simmons', 'Simpson', 'Sims', 'Smith', 'Snyder', 'Soto', 'Spencer', 'Stanley', 'Stephens',
            'Stevens', 'Stewart', 'Stone', 'Sullivan', 'Sutton', 'Taylor', 'Terry', 'Thomas', 'Thompson', 'Torres',
            'Tucker', 'Turner', 'Vargas', 'Vasquez', 'Wade', 'Wagner', 'Walker', 'Wallace', 'Walters', 'Ward',
            'Warren', 'Washington', 'Watkins', 'Watson', 'Watts', 'Weaver', 'Webb', 'Welch', 'Wells', 'West',
            'Wheeler', 'White', 'Williams', 'Williamson', 'Willis', 'Wilson', 'Wood', 'Woods', 'Wright', 'Young'
        ];
        return $arr[array_rand($arr)];
    }

    /**
     * Returns person's first name
     * @param string $sex Sex of the last name. m - Male, f - female
     * @return string Random first name
     */
    public function getFirstName($sex) 
    {
        $arr = $sex == self::SEX_MALE ? $this->getFirstNameMale() : $this->getFirstNameFemale();
        return $arr[array_rand($arr)];
    }

    /**
     * Returns person's middle name
     * @param string $sex Sex of the middle name. m - Male, f - female
     * @return string Random middle name
     */
    public function getMiddleName($sex) 
    {
        $arr = $sex == self::SEX_MALE ? $this->getMiddleNameMale() : $this->getMiddleNameFemale();
        return $arr[array_rand($arr)];
    }
    
    /**
     * Returns format of the name
     * @return string f - first name, l - last name, 
     * m - middle name, m1 - first letter of middle name, 
     * f1 - first letter of first name
     */
    function getFormat() {
        return $this->format;
    }

    /**
     * 
     * @param string $format f - first name, l - last name, 
     * m - middle name, m1 - first letter of middle name, 
     * f1 - first letter of first name
     */
    function setFormat($format) {
        $this->format = $format;
    }

    /**
     * Returns list of female first name
     * @return array List of female first name
     */
    public function getFirstNameFemale()
    {
        return [
            'Aaliyah', 'Abigail', 'Adaline', 'Adalyn', 'Adalynn', 'Addison', 'Adeline', 'Adelyn', 'Alaina', 'Alexa',
            'Alexandra', 'Alexis', 'Alice', 'Alina', 'Aliyah', 'Allison', 'Alyssa', 'Amelia', 'Amy', 'Anastasia',
            'Andrea', 'Angelina', 'Anna', 'Annabelle', 'Arabella', 'Aria', 'Ariana', 'Arianna', 'Ariel', 'Arya',
            'Ashley', 'Athena', 'Aubree', 'Aubrey', 'Audrey', 'Aurora', 'Autumn', 'Ava', 'Avery', 'Bailey',
            'Bella', 'Brianna', 'Brielle', 'Brooke', 'Brooklyn', 'Brooklynn', 'Camila', 'Caroline', 'Catherine', 'Cecilia',
            'Charlie', 'Charlotte', 'Chloe', 'Claire', 'Clara', 'Cora', 'Daisy', 'Daniela', 'Delilah', 'Eden',
            'Eleanor', 'Elena', 'Eliana', 'Elise', 'Eliza', 'Elizabeth', 'Ella', 'Ellie', 'Emerson', 'Emery',
            'Emilia', 'Emily', 'Emma', 'Esther', 'Eva', 'Evelyn', 'Everly', 'Faith', 'Finley', 'Gabriella',
            'Genesis', 'Genevieve', 'Gianna', 'Grace', 'Gracie', 'Hadley', 'Hailey', 'Hannah', 'Harmony', 'Harper',
            'Hazel', 'Iris', 'Isabel', 'Isabella', 'Isabelle', 'Isla', 'Ivy', 'Jade', 'Jasmine', 'Jocelyn',
            'Jordyn', 'Josephine', 'Julia', 'Juliana', 'Julianna', 'Juliette', 'Katherine', 'Kayla', 'Kaylee', 'Kendall',
            'Kennedy', 'Khloe', 'Kimberly', 'Kinsley', 'Kylie', 'Laila', 'Lauren', 'Layla', 'Leah', 'Leilani',
            'Liliana', 'Lillian', 'Lilly', 'Lily', 'London', 'Londyn', 'Lucy', 'Luna', 'Lydia', 'Lyla',
            'Mackenzie', 'Madeline', 'Madelyn', 'Madison', 'Makayla', 'Margaret', 'Maria', 'Mariah', 'Mary', 'Maya',
            'Mckenzie', 'Melanie', 'Melody', 'Mia', 'Mila', 'Molly', 'Morgan', 'Mya', 'Naomi', 'Natalia',
            'Natalie', 'Nevaeh', 'Nicole', 'Nora', 'Norah', 'Nova', 'Olivia', 'Paige', 'Paisley', 'Payton',
            'Penelope', 'Peyton', 'Piper', 'Quinn', 'Rachel', 'Raelynn', 'Reagan', 'Reese', 'Riley', 'Rose',
            'Ruby', 'Rylee', 'Ryleigh', 'Sadie', 'Samantha', 'Sara', 'Sarah', 'Savannah', 'Scarlett', 'Serenity',
            'Skylar', 'Sofia', 'Sophia', 'Sophie', 'Stella', 'Sydney', 'Taylor', 'Teagan', 'Trinity', 'Valentina',
            'Valeria', 'Valerie', 'Vanessa', 'Victoria', 'Violet', 'Vivian', 'Willow', 'Ximena', 'Zoe', 'Zoey'
        ];
    }

    /**
     * Returns list of male first name
     * @return array List of male first name
     */
    public function getFirstNameMale()
    {
        return [
            'Aaron', 'Abel', 'Abraham', 'Adam', 'Adrian', 'Aidan', 'Aiden', 'Alan', 'Alejandro', 'Alex',
            'Alexander', 'Amir', 'Andrew', 'Angel', 'Anthony', 'Antonio', 'Asher', 'Ashton', 'August',
            'Austin', 'Avery', 'Axel', 'Ayden', 'Beau', 'Benjamin', 'Bennett', 'Bentley', 'Blake', 'Bradley', 
            'Brandon', 'Brantley', 'Braxton', 'Brayden', 'Brody', 'Bryan', 'Bryce', 'Bryson', 'Caleb', 'Calvin',
            'Camden', 'Cameron', 'Carlos', 'Carson', 'Carter', 'Charles', 'Chase', 'Christian', 'Christopher', 'Cole',
            'Colin', 'Colton', 'Connor', 'Cooper', 'Damian', 'Daniel', 'David', 'Declan', 'Diego', 'Dominic',
            'Dylan', 'Easton', 'Edward', 'Eli', 'Elias', 'Elijah', 'Elliot', 'Elliott', 'Emmanuel', 'Emmett',
            'Eric', 'Ethan', 'Evan', 'Everett', 'Ezekiel', 'Ezra', 'Finn', 'Gabriel', 'Gael', 'Gavin',
            'George', 'Giovanni', 'Graham', 'Grant', 'Grayson', 'Greyson', 'Harrison', 'Hayden', 'Henry', 'Hudson',
            'Hunter', 'Ian', 'Isaac', 'Isaiah', 'Ivan', 'Jace', 'Jack', 'Jackson', 'Jacob', 'James',
            'Jameson', 'Jason', 'Jaxon', 'Jaxson', 'Jayce', 'Jayden', 'Jeremiah', 'Jeremy', 'Jesse', 'Jesus',
            'Joel', 'John', 'Jonah', 'Jonathan', 'Jordan', 'Jose', 'Joseph', 'Joshua', 'Josiah', 'Juan',
            'Jude', 'Julian', 'Justin', 'Kaden', 'Kai', 'Kaiden', 'Kaleb', 'Karter', 'Kayden', 'Kevin',
            'King', 'Kingston', 'Kyle', 'Landon', 'Leo', 'Leonardo', 'Levi', 'Liam', 'Lincoln', 'Logan',
            'Luca', 'Lucas', 'Luis', 'Luke', 'Maddox', 'Malachi', 'Marcus', 'Mark', 'Mason', 'Mateo',
            'Matteo', 'Matthew', 'Maverick', 'Max', 'Maximus', 'Maxwell', 'Micah', 'Michael', 'Miguel', 'Miles',
            'Nathan', 'Nathaniel', 'Nicholas', 'Nicolas', 'Nolan', 'Oliver', 'Oscar', 'Owen', 'Parker', 'Patrick',
            'Preston', 'Richard', 'Robert', 'Roman', 'Rowan', 'Ryan', 'Ryder', 'Ryker', 'Samuel', 'Santiago',
            'Sawyer', 'Sebastian', 'Silas', 'Steven', 'Theodore', 'Thomas', 'Timothy', 'Tristan', 'Tucker', 'Tyler',
            'Victor', 'Vincent', 'Waylon', 'Wesley', 'Weston', 'William', 'Wyatt', 'Xavier', 'Zachary', 'Zayden'
        ];
    }
    
    /**
     * Returns list of female middle names
     * @return array list of female middle names
     */
    public function getMiddleNameFemale()
    {
        return [
            'Adele', 'Alice', 'Allison', 'Anise', 'Ann', 'Arden', 'Aryn', 'Ashten', 'Bailee', 'Berlynn',
            'Bernice', 'Blaire', 'Blaise', 'Blake', 'Blanche', 'Blayne', 'Bree', 'Breean', 'Brighton', 'Brooke',
            'Camden', 'Candice', 'Caprice', 'Carelyn', 'Caren', 'Carleen', 'Carlen', 'Catheryn', 'Caylen', 'Cerise',
            'Coreen', 'Dawn', 'Debree', 'Denise', 'Devon', 'Dustin', 'Elein', 'Ellen', 'Ellice', 'Ellison',
            'Erin', 'Eve', 'Fawn', 'Faye', 'Fern', 'Haiden', 'Hollyn', 'Hope', 'Jacklyn', 'Jae',
            'Jaidyn', 'Jakolyn', 'Jane', 'Javan', 'Joan', 'Jolee', 'Jordon', 'Julian', 'June', 'Kae',
            'Kaitlin', 'Kalan', 'Karilyn', 'Kate', 'Kathryn', 'Korin', 'Krystan', 'Kylie', 'Lane', 'Lashon',
            'Lee', 'Love', 'Lynn', 'Madisen', 'Mae', 'Meaghan', 'Merle', 'Monteen', 'Nadeen', 'Naveen',
            'Ocean', 'Olive', 'Payten', 'Raine', 'Raven', 'Rayleen', 'Reagan', 'Rene', 'Robin', 'Rose',
            'Rylie', 'Selene', 'Sharon', 'Sherleen', 'Sue', 'Suzan', 'Taye', 'Taylore', 'Zion', 'Zoe'
        ];
    }
    
    /**
     * Returns list of male middle names
     * @return array List of male middle names
     */
    public function getMiddleNameMale()
    {
        return [
            'Aaron', 'Aiden', 'Anton', 'Aubrey', 'Avery', 'Bailey ', 'Bennett', 'Blair', 'Braiden', 'Brendon',
            'Brett', 'Brian', 'Bryce', 'Byron', 'Carson', 'Chance', 'Charles', 'Chase', 'Claude', 'Clinton',
            'Colten', 'Conrad', 'Craig', 'Cullen', 'Damon', 'Dante', 'Dawson', 'Dayton', 'Denver', 'Denzel',
            'Dillon', 'Drake', 'Dwayne', 'Edwin', 'Ellis', 'Emmett', 'Ethan', 'Francis', 'Garrett', 'Glenn',
            'Grant', 'Holden', 'Houston', 'Hyrum', 'Ivan', 'Jace', 'Jackson', 'Jade', 'Jarrett', 'Juan',
            'Justin', 'Keaton', 'Kelton', 'Layne', 'Layton', 'Lincoln', 'Louis', 'Lyle', 'Malcolm', 'Marshall',
            'Mitchell', 'Myron', 'Noah', 'Noel', 'Owen', 'Payton', 'Peyton', 'Preston', 'Quinn', 'Quintin',
            'Randall', 'Reese', 'Rhett', 'Riley', 'River', 'Rory', 'Ryder', 'Sawyer', 'Sean', 'Seth',
            'Shane', 'Tilton', 'Shelton', 'Stewart', 'Tanner', 'Taylor', 'Thomas', 'Trevor', 'Trenton', 'Tristan',
            'Tyrone', 'Tyson', 'Vernon', 'Wade', 'Warren', 'Wesley', 'Weston', 'Wilson', 'Winston', 'Zachariah'
        ];
    }
}
