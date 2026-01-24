<?php
/**
 * Room constants and data
 * Contains room arrays for Regular, Deluxe, and Suite rooms
 */

// Pricing for all room types
$ROOM_PRICING = [
  'regular' => [
    'single' => 100.00,
    'double' => 200.00,
    'family' => 500.00
  ],
  'deluxe' => [
    'single' => 300.00,
    'double' => 500.00,
    'family' => 750.00
  ],
  'suite' => [
    'single' => 500.00,
    'double' => 800.00,
    'family' => 1000.00
  ]
];

// Regular rooms array
$REGULAR_ROOMS = [
  [
    'image' => 'regular-room-one.webp',
    'name' => 'Regular Room 1',
    'description' => 'Comfortable and cozy accommodation perfect for solo travelers.',
    'detailed_description' => 'This comfortable and cozy accommodation is perfect for solo travelers seeking a peaceful retreat. The room features a well-appointed single bed, modern amenities, and a serene atmosphere that ensures a restful stay. Ideal for business travelers or those looking for a quiet escape.',
    'capacity' => '1 guest',
    'price' => $ROOM_PRICING['regular']['single']
  ],
  [
    'image' => 'regular-room-two.webp',
    'name' => 'Regular Room 2',
    'description' => 'Spacious room with modern amenities for a relaxing stay.',
    'detailed_description' => 'Experience comfort in this spacious room designed with modern amenities for a truly relaxing stay. The room offers ample space, contemporary furnishings, and all the essentials you need for a pleasant visit. Perfect for couples or friends traveling together.',
    'capacity' => '2 guests',
    'price' => $ROOM_PRICING['regular']['double']
  ],
  [
    'image' => 'regular-room-three.webp',
    'name' => 'Regular Room 3',
    'description' => 'Affordable comfort with all essential amenities included.',
    'detailed_description' => 'Enjoy affordable comfort without compromising on quality. This room includes all essential amenities to make your stay convenient and enjoyable. Clean, well-maintained, and thoughtfully designed to provide excellent value for money.',
    'capacity' => '1 guest',
    'price' => $ROOM_PRICING['regular']['single']
  ],
  [
    'image' => 'regular-room-four.webp',
    'name' => 'Regular Room 4',
    'description' => 'Perfect for couples seeking comfort and value.',
    'detailed_description' => 'Designed with couples in mind, this room offers the perfect balance of comfort and value. The cozy space features comfortable bedding, modern amenities, and a welcoming atmosphere that makes it ideal for romantic getaways or weekend escapes.',
    'capacity' => '2 guests',
    'price' => $ROOM_PRICING['regular']['double']
  ],
  [
    'image' => 'regular-room-five.webp',
    'name' => 'Regular Room 5',
    'description' => 'Family-friendly room with extra space and comfort.',
    'detailed_description' => 'This family-friendly room provides extra space and comfort for families traveling together. With accommodations for up to four guests, the room features multiple sleeping arrangements, additional storage space, and amenities that cater to families with children.',
    'capacity' => '4 guests',
    'price' => $ROOM_PRICING['regular']['family']
  ],
  [
    'image' => 'regular-room-six.webp',
    'name' => 'Regular Room 6',
    'description' => 'Cozy retreat with all the essentials for a pleasant stay.',
    'detailed_description' => 'A cozy retreat that includes all the essentials for a pleasant stay. This room combines comfort and functionality, offering a peaceful environment where you can unwind after a day of exploring. Perfect for travelers who appreciate simplicity and comfort.',
    'capacity' => '2 guests',
    'price' => $ROOM_PRICING['regular']['double']
  ],
  [
    'image' => 'regular-room-seven.webp',
    'name' => 'Regular Room 7',
    'description' => 'Budget-friendly option without compromising on comfort.',
    'detailed_description' => 'A budget-friendly option that doesn\'t compromise on comfort. This room provides excellent value with clean accommodations, essential amenities, and a comfortable environment. Ideal for budget-conscious travelers who still want a quality stay experience.',
    'capacity' => '1 guest',
    'price' => $ROOM_PRICING['regular']['single']
  ],
  [
    'image' => 'regular-room-eight.webp',
    'name' => 'Regular Room 8',
    'description' => 'Spacious family room perfect for groups.',
    'detailed_description' => 'This spacious family room is perfect for groups and families. With generous space to accommodate multiple guests comfortably, the room features family-friendly amenities and a layout designed to make group stays enjoyable and convenient.',
    'capacity' => '4 guests',
    'price' => $ROOM_PRICING['regular']['family']
  ]
];

// Deluxe rooms array
$DELUXE_ROOMS = [
  [
    'image' => 'deluxe-room-one.webp',
    'name' => 'De Luxe Room 1',
    'description' => 'Premium accommodation with luxury amenities and elegant design.',
    'detailed_description' => 'Indulge in premium accommodation featuring luxury amenities and elegant design. This deluxe room offers a sophisticated atmosphere with high-quality furnishings, premium bedding, and thoughtful touches throughout. Experience elevated comfort and style in every detail.',
    'capacity' => '2 guests',
    'price' => $ROOM_PRICING['deluxe']['double']
  ],
  [
    'image' => 'deluxe-room-two.webp',
    'name' => 'De Luxe Room 2',
    'description' => 'Spacious deluxe room perfect for a comfortable stay.',
    'detailed_description' => 'Enjoy a spacious deluxe room designed for maximum comfort during your stay. The generous layout provides plenty of room to relax, work, or unwind. Premium amenities and elegant decor create an atmosphere of refined luxury and relaxation.',
    'capacity' => '2 guests',
    'price' => $ROOM_PRICING['deluxe']['double']
  ],
  [
    'image' => 'deluxe-room-three.jpg',
    'name' => 'De Luxe Room 3',
    'description' => 'Luxurious room with modern comforts and premium features.',
    'detailed_description' => 'Experience luxury in this beautifully appointed room that combines modern comforts with premium features. From high-end furnishings to state-of-the-art amenities, every element has been carefully selected to provide an exceptional stay experience.',
    'capacity' => '1 guest',
    'price' => $ROOM_PRICING['deluxe']['single']
  ],
  [
    'image' => 'deluxe-room-four.jpg',
    'name' => 'De Luxe Room 4',
    'description' => 'Elegant deluxe accommodation with stunning views.',
    'detailed_description' => 'Stay in elegant deluxe accommodation that offers stunning views and sophisticated design. The room features large windows to take advantage of the scenery, premium furnishings, and an ambiance that reflects refined taste and attention to detail.',
    'capacity' => '2 guests',
    'price' => $ROOM_PRICING['deluxe']['double']
  ],
  [
    'image' => 'deluxe-room-five.jpg',
    'name' => 'De Luxe Room 5',
    'description' => 'Family-friendly deluxe room with extra space and luxury.',
    'detailed_description' => 'A family-friendly deluxe room that combines extra space with luxury amenities. Designed to accommodate families comfortably, this room features premium furnishings, additional space for relaxation, and luxury touches that make family travel more enjoyable.',
    'capacity' => '4 guests',
    'price' => $ROOM_PRICING['deluxe']['family']
  ],
  [
    'image' => 'deluxe-room-six.jpg',
    'name' => 'De Luxe Room 6',
    'description' => 'Premium comfort with sophisticated design elements.',
    'detailed_description' => 'Experience premium comfort enhanced by sophisticated design elements throughout. This room showcases attention to detail in every aspect, from the carefully curated decor to the premium amenities that ensure a memorable and comfortable stay.',
    'capacity' => '2 guests',
    'price' => $ROOM_PRICING['deluxe']['double']
  ],
  [
    'image' => 'deluxe-room-seven.jpg',
    'name' => 'De Luxe Room 7',
    'description' => 'Luxury accommodation with all premium amenities.',
    'detailed_description' => 'Luxury accommodation that includes all premium amenities for an exceptional stay. This room features top-of-the-line furnishings, advanced technology, and premium services that define true luxury hospitality. Every detail is designed to exceed expectations.',
    'capacity' => '1 guest',
    'price' => $ROOM_PRICING['deluxe']['single']
  ],
  [
    'image' => 'deluxe-room-eight.jpg',
    'name' => 'De Luxe Room 8',
    'description' => 'Spacious family deluxe room with luxury features.',
    'detailed_description' => 'A spacious family deluxe room that combines generous space with luxury features. Perfect for families seeking an elevated experience, this room offers premium accommodations, luxury amenities, and thoughtful touches that make family stays special.',
    'capacity' => '4 guests',
    'price' => $ROOM_PRICING['deluxe']['family']
  ]
];

// Suite rooms array
$SUITE_ROOMS = [
  [
    'image' => 'suite-room-one.webp',
    'name' => 'Suite Room 1',
    'description' => 'Ultimate luxury with spacious accommodations and premium amenities.',
    'detailed_description' => 'Experience ultimate luxury in this spacious suite featuring premium amenities and elegant accommodations. The suite offers separate living and sleeping areas, high-end furnishings, and exclusive amenities that create an unparalleled hospitality experience. Perfect for those seeking the finest in comfort and style.',
    'capacity' => '2 guests',
    'price' => $ROOM_PRICING['suite']['double']
  ],
  [
    'image' => 'suite-room-two.webp',
    'name' => 'Suite Room 2',
    'description' => 'Elegant suite featuring sophisticated design and comfort.',
    'detailed_description' => 'An elegant suite that features sophisticated design and exceptional comfort throughout. The thoughtfully designed space combines luxury furnishings with modern amenities, creating an atmosphere of refined elegance. Every element has been carefully curated for an unforgettable stay.',
    'capacity' => '2 guests',
    'price' => $ROOM_PRICING['suite']['double']
  ],
  [
    'image' => 'suite-room-three.webp',
    'name' => 'Suite Room 3',
    'description' => 'Premium suite with exclusive amenities and stunning views.',
    'detailed_description' => 'A premium suite offering exclusive amenities and stunning views that enhance your stay experience. The suite features expansive windows, luxury accommodations, and exclusive services that set it apart. Enjoy breathtaking scenery while indulging in the finest hospitality.',
    'capacity' => '1 guest',
    'price' => $ROOM_PRICING['suite']['single']
  ],
  [
    'image' => 'suite-room-four.webp',
    'name' => 'Suite Room 4',
    'description' => 'Luxurious suite perfect for a memorable stay experience.',
    'detailed_description' => 'A luxurious suite designed to create a memorable stay experience. This exceptional accommodation features spacious living areas, premium furnishings, and exclusive amenities that ensure every moment is special. Ideal for celebrations, special occasions, or simply treating yourself to the best.',
    'capacity' => '2 guests',
    'price' => $ROOM_PRICING['suite']['double']
  ],
  [
    'image' => 'suite-room-five.webp',
    'name' => 'Suite Room 5',
    'description' => 'Spacious family suite with luxury features and extra comfort.',
    'detailed_description' => 'A spacious family suite that combines luxury features with extra comfort for families. The suite provides ample space for families to relax together, premium amenities throughout, and thoughtful touches that make family travel more enjoyable. Experience luxury hospitality designed for families.',
    'capacity' => '4 guests',
    'price' => $ROOM_PRICING['suite']['family']
  ],
  [
    'image' => 'suite-room-six.webp',
    'name' => 'Suite Room 6',
    'description' => 'Exclusive suite with premium amenities and elegant design.',
    'detailed_description' => 'An exclusive suite featuring premium amenities and elegant design that creates a truly special accommodation experience. The suite showcases sophisticated decor, high-end amenities, and exclusive services that define luxury hospitality at its finest.',
    'capacity' => '2 guests',
    'price' => $ROOM_PRICING['suite']['double']
  ],
  [
    'image' => 'suite-room-seven.webp',
    'name' => 'Suite Room 7',
    'description' => 'Ultimate comfort in our most luxurious suite accommodation.',
    'detailed_description' => 'Experience ultimate comfort in our most luxurious suite accommodation. This premier suite represents the pinnacle of hospitality, featuring the finest furnishings, most exclusive amenities, and exceptional service. Every detail has been perfected to provide an unparalleled luxury experience.',
    'capacity' => '1 guest',
    'price' => $ROOM_PRICING['suite']['single']
  ],
  [
    'image' => 'suite-room-eight.webp',
    'name' => 'Suite Room 8',
    'description' => 'Grand family suite with all luxury amenities included.',
    'detailed_description' => 'A grand family suite that includes all luxury amenities for an exceptional family stay. This expansive suite offers generous space for families, premium accommodations throughout, and luxury amenities that ensure every family member enjoys a memorable experience. The perfect choice for families seeking the ultimate in comfort and luxury.',
    'capacity' => '4 guests',
    'price' => $ROOM_PRICING['suite']['family']
  ]
];

/**
 * Map capacity string to capacity type
 */
function getCapacityType($capacity) {
  $capacity = strtolower(trim($capacity));
  if (strpos($capacity, '1') !== false || strpos($capacity, 'single') !== false) {
    return 'single';
  } elseif (strpos($capacity, '4') !== false || strpos($capacity, 'family') !== false) {
    return 'family';
  } else {
    return 'double';
  }
}

/**
 * Simple calculation function
 * Returns: [subTotal, discount, additionalCharge, totalBill]
 */
function calculateTotal($days, $roomType, $roomCapacity, $paymentType) {
  $rates = [
    'single' => ['regular' => 100.00, 'deluxe' => 300.00, 'suite' => 500.00],
    'double' => ['regular' => 200.00, 'deluxe' => 500.00, 'suite' => 800.00],
    'family' => ['regular' => 500.00, 'deluxe' => 750.00, 'suite' => 1000.00],
  ];

  $rate = $rates[$roomCapacity][$roomType];
  $subTotal = $rate * $days;

  $discount = 0;
  if ($days >= 3 && $days <= 5 && $paymentType == 'cash') {
    $discount = $subTotal * 0.10;
  } elseif ($days >= 6 && $paymentType == 'cash') {
    $discount = $subTotal * 0.15;
  }

  $subTotalAfterDiscount = $subTotal - $discount;

  if ($paymentType == 'cheque') {
    $additionalCharge = $subTotalAfterDiscount * 0.05;
  } elseif ($paymentType == 'credit') {
    $additionalCharge = $subTotalAfterDiscount * 0.10;
  } else {
    $additionalCharge = 0;
  }

  $totalBill = $subTotalAfterDiscount + $additionalCharge;

  return [$subTotal, $discount, $additionalCharge, $totalBill];
}

