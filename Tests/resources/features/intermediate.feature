Feature: It faisl sometimes

  Scenario: maybe-ok - invalid scenario 1
    Given anything false
    When anything false
    Then anything false

  Scenario: maybe-ok - valid scenario 2
    Given anything true
    Given anything true
    When anything true
    Then anything true

  Scenario: maybe-ok - valid scenario 3
    Given anything true
    When anything true
    Then anything true

  Scenario: maybe-ok - invalid scenario 4
    Given anything false
    When anything false
    Then anything false
    Then anything false