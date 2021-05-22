# Cowin API SDK

PHP SDK based on public cowin api.

## Usage

Extend the class with ```Api\Cowin``` class or simply instantiate the class ```Api\Cowin```.
```php
class api{
    function get_states();
    function get_districts($state_name);
    function get_sessions_by_pin($pincode,$date);
    function get_sessions_by_district($state,$district,$date);
    function get_calender_by_pin($pincode,$date);
    function get_calender_by_district($state,$district,$date);
}


```


## License
[MIT](https://choosealicense.com/licenses/mit/)