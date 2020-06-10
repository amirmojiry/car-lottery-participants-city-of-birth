SELECT national_codes.province, COUNT(cars.national_code) AS national_count FROM national_codes
LEFT JOIN cars ON cars.first_digits = national_codes.code
GROUP BY province
ORDER BY province