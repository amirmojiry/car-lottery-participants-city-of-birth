SELECT national_codes.province, COUNT(cars.national_code) AS national_codes_count FROM national_codes
RIGHT JOIN cars ON cars.first_digits = national_codes.first_digits
WHERE national_codes.duplicate = 0
GROUP BY province