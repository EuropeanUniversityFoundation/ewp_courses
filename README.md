# EWP Courses

Drupal implementation of the EWP Courses API.

See the **Erasmus Without Paper** specification for more information:

  - [Courses API](https://github.com/erasmus-without-paper/ewp-specs-api-courses)

## Installation

Include the repository in your project's `composer.json` file:

    "repositories": [
        ...
        {
            "type": "vcs",
            "url": "https://github.com/EuropeanUniversityFoundation/ewp_courses"
        }
    ],

Then you can require the package as usual:

    composer require euf/ewp_courses

Finally, install the module:

    drush en ewp_courses

## Usage

Two custom content entities named **Learning Opportunity Specification** and **Learning Opportunity Instance** are provided with initial configuration to match the EWP specification. They can be configured like any other fieldable entity on the system. The administration paths are placed under `/admin/ewp/`.
