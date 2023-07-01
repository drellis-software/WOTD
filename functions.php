<!--
Devin Ellis
functions.php
CSC 242, Fall 2022, Assignment FINAL
Purpose: Functions to be used during sign in and create account 
along with create record query
Citation: Citation: Dr. Schwesigner's Project 9 handout
-->

<?php

function printTable($data) {
    if (count($data) === 0) {
        return;
    }
    $header = array_keys($data[0]);
    print "<table>\n";
    print "<tr>";
    foreach ($header as $h) {
        print "<th>$h</th>";
    }
    print "</tr>\n";
    foreach ($data as $record) {
        $values = array_values($record);
        print "<tr>";
        foreach ($values as $v) {
            print "<td>$v</td>";
        }
        print "</tr>\n";
    }
    print "</table>";
}

function printFormTable($data) {
    if (count($data) === 0) {
        return;
    }
    $header = array_keys($data[0]);
    print "<table>\n";
    print "<tr>";
    print "<th>Select</th>";
    foreach ($header as $h) {
        print "<th>$h</th>";
    }
    print "</tr>\n";
    foreach ($data as $record) {
        $values = array_values($record);
        $form_value = implode(',', $values);
        print "<tr>";
        print "<td><input type=\"checkbox\" name=\"rows[]\" value=\"$form_value\"></td>";
        foreach ($values as $v) {
            print "<td>$v</td>";
        }
        print "</tr>\n";
    }
    print "</table>";
}

/* Function Name: insertRecord
 * Description: insert record information into the database
 * Parameters: (string) $year: the record's year
 *             (string) $wins: the record's wins
 *             (string) $losses: the record's losses
 *             (string) $playoffs: the record's playoffs
 * Return Value: (boolean) TRUE if the information was successfully inserted,
 *               otherwise FALSE
 */
function insertWeddle($name, $date, $wins, $losses, $ties, $guesses) {

    // try to insert into the database
    // if an error occurs return FALSE
    try {
        $db =  new PDO("sqlite:standings.db");
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "INSERT INTO weddle VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $db->prepare($sql);
        $stmt->execute([$name, $date, $wins, $losses, $ties, $guesses]);
        return TRUE;
    }
    catch (Exception $e) {
        print "<p>$e</p>";
        return FALSE;
    }
}
function insertHard($name, $date, $wins, $losses, $ties, $guesses) {

    // try to insert into the database
    // if an error occurs return FALSE
    try {
        $db =  new PDO("sqlite:standings.db");
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "INSERT INTO hard VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $db->prepare($sql);
        $stmt->execute([$name, $date, $wins, $losses, $ties, $guesses]);
        return TRUE;
    }
    catch (Exception $e) {
        print "<p>$e</p>";
        return FALSE;
    }
}
function insertPickle($name, $date, $wins, $losses, $ties, $guesses) {

    // try to insert into the database
    // if an error occurs return FALSE
    try {
        $db =  new PDO("sqlite:standings.db");
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "INSERT INTO pickle VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $db->prepare($sql);
        $stmt->execute([$name, $date, $wins, $losses, $ties, $guesses]);
        return TRUE;
    }
    catch (Exception $e) {
        print "<p>$e</p>";
        return FALSE;
    }
}

function insertOverall($name, $date, $wins, $losses, $ties, $points) {

    // try to insert into the database
    // if an error occurs return FALSE
    try {
        $db =  new PDO("sqlite:standings.db");
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "INSERT INTO standings VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $db->prepare($sql);
        $stmt->execute([$name, $date, $wins, $losses, $ties, $points]);
        return TRUE;
    }
    catch (Exception $e) {
        print "<p>$e</p>";
        return FALSE;
    }
}

?>
