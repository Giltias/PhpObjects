<?php

use Templates\Composite\Archer;
use Templates\Composite\Army;
use Templates\Composite\LaserCannonUnit;
use Templates\Decorator\DiamondDecorator;
use Templates\Decorator\Plains;
use Templates\Decorator\PollutedPlains;
use Templates\FactoryMethod\BloggsCommManager;
use Templates\FactoryMethod\CommsManager;
use Templates\Interpreter\BooleanOrExpression;
use Templates\Interpreter\EqualsExpression;
use Templates\Interpreter\InterpreterContext;
use Templates\Interpreter\LiteralExpression;
use Templates\Interpreter\VariableExpression;
use Templates\Observer\GeneralLogger;
use Templates\Observer\Login;
use Templates\Observer\PartnershipTool;
use Templates\Observer\SecurityMonitor;
use Templates\Singletone\Preferences;
use Templates\Strategy\FixedCostStrategy;
use Templates\Strategy\Lecture;
use Templates\Strategy\Lesson;
use Templates\Strategy\RegistrationMgr;
use Templates\Strategy\Seminar;
use Templates\Strategy\TimedCostStrategy;
use Templates\Strategy1\MarkLogicMarker;
use Templates\Strategy1\MatchMarker;
use Templates\Strategy1\RegexpMarker;
use Templates\Strategy1\TextQuestion;
use Templates\Visitor\Archer as Archer1;
use Templates\Visitor\Army as Army1;
use Templates\Visitor\Cavalry;
use Templates\Visitor\LaserCannonUnit as LaserCannonUnit1;
use Templates\Visitor\TaxCollectionVisitor;
use Templates\Visitor\TextDumpArmyVisitor;

require_once './vendor/autoload.php';

$lessons[] = new Seminar(4, new TimedCostStrategy());
$lessons[] = new Lecture(4, new FixedCostStrategy());

/**
 * @var $lesson Lesson
 */
foreach ($lessons as $lesson) {
    echo "Плата за занятие {$lesson->cost()}. ";
    echo "Тип оплаты: {$lesson->chargeType()}<br />";
}
echo "<br />";

$mgr = new RegistrationMgr();
$mgr->register($lessons[0]);
$mgr->register($lessons[1]);
echo "<br />";

$pref = Preferences::getInstance();
$pref->setProperty('name', 'Иван');

unset($pref);

$pref2 = Preferences::getInstance();
echo $pref2->getProperty('name') . "<br />";
echo "<br />";

$mgr = new BloggsCommManager();
echo $mgr->getHeaderText();
echo $mgr->getApptEncoder()->encode();
echo $mgr->getFooterText();
echo "<br />";

$main_army = new Army();
$main_army->addUnit(new Archer());
$main_army->addUnit(new LaserCannonUnit());

$sub_army = new Army();
$sub_army->addUnit(new Archer());
$sub_army->addUnit(new Archer());
$sub_army->addUnit(new Archer());

$main_army->addUnit($sub_army);

echo "Атакующая сила: {$main_army->bombardStrength()} <br />";
echo "<br />";

$tile = new DiamondDecorator(new Plains());
echo $tile->getWealthFactor() . "<br />";
echo "<br />";

$context = new InterpreterContext();
$myVar = new VariableExpression('input', 'Четыре');
$myVar->interpret($context);
echo $context->lookup($myVar) . "<br />";

$newVar = new VariableExpression('input');
$newVar->interpret($context);
echo $context->lookup($newVar) . "<br />";

$myVar->setValue('Пять');
$myVar->interpret($context);
echo $context->lookup($myVar) . "<br />";
echo $context->lookup($newVar) . "<br />";
echo "<br />";

$context = new InterpreterContext();
$input = new VariableExpression('input');
$statement = new BooleanOrExpression(
    new EqualsExpression($input, new LiteralExpression('Четыре')),
    new EqualsExpression($input, new LiteralExpression('4'))
);

foreach (['Четыре', '4', '52'] as $val) {
    $input->setValue($val);
    echo  "$val:<br />";
    $statement->interpret($context);
    if ($context->lookup($statement)) {
        echo "соотвествует <br><br>";
    } else {
        echo "не соответствует <br><br>";
    }
}
echo "<br />";

$markers = [
    new RegexpMarker('/F.ve/'),
    new MatchMarker('Five'),
    new MarkLogicMarker('$input equals "Five"')
];

foreach ($markers as $marker) {
    echo get_class($marker)."<br>";
    $question = new TextQuestion("Сколько лучей у кремлевской звезды?", $marker);

    foreach (['Five', 'Four'] as $response) {
        echo "Ответ: $response: ";
        if ($question->mark($response)) {
            echo "\tПравильно! <br>";
        } else {
            echo "\tНеверно! <br>";
        }
    }
}
echo "<br />";

$login = new Login();
new SecurityMonitor($login);
new GeneralLogger($login);
new PartnershipTool($login);
echo "<br />";

$main_army1 = new Army1();
$main_army1->addUnit(new Archer1());
$main_army1->addUnit(new LaserCannonUnit1());
$main_army1->addUnit(new Cavalry());
$taxCollector = new TaxCollectionVisitor();
$textDump = new TextDumpArmyVisitor();
$main_army1->accept($textDump);
echo $textDump->getText();
$main_army1->accept($taxCollector);
echo $taxCollector->getReport() . "<br>";
echo "ИТОГО: ";
echo $taxCollector->getTax() . "<br>";
