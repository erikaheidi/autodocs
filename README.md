Autodocs is a PHP library designed to facilitate building highly customizable automated docs based on markdown templates and JSON data sources. It provides a layer of abstraction on top of which you can create your own documentation factory.

Autodocs was built to be combined with a [Minicli](https://docs.minicli.dev) application, making it suitable for running as a scheduled task on GitHub Actions.

## Requirements

- PHP >= 8.2
- Composer
- ext-json

Visit the [Autodocs Wiki](https://github.com/erikaheidi/autodocs/wiki) for architecture details and basic documentation.

## Tutorial

For a detailed guide on how to implement an Autodocs application, check the tutorial on DEV: [Creating an Automated Documentation Pipeline in PHP with Autodocs and GitHub Actions](https://dev.to/erikaheidi/creating-an-automated-documentation-pipeline-in-php-with-autodocs-and-github-actions-1464). It covers everything from bootstrapping a new Minicli app and configuring it with Autodocs, creating a custom documentation page, setting up a JSON data source, and setting up a custom layout for a README page. The tutorial also covers how to create a GitHub Actions workflow to run this application and create a pull request when there are changes in the generated docs.

## Demo

A demo implementation that generates JSON-based README files is available in this repo: https://github.com/erikaheidi/autodocs-demo