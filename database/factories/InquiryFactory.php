<?php

namespace Database\Factories;

use App\Models\Inquiry;
use Illuminate\Database\Eloquent\Factories\Factory;

class InquiryFactory extends Factory
{
  protected $model = Inquiry::class;

  public function definition(): array
  {
    // Subject + Message pairs
    $inquiries = [
      [
        'subject' => 'Loan Application Requirements',
        'message' => 'Hi, I would like to know the complete list of requirements needed to apply for a loan. Kindly provide the necessary documents I need to prepare.'
      ],
      [
        'subject' => 'Membership Eligibility',
        'message' => 'Good day! I’m interested in joining your cooperative. Can you tell me what the qualifications are for becoming a member?'
      ],
      [
        'subject' => 'Share Capital Contribution',
        'message' => 'Hello, I want to increase my share capital. What is the process and is there a minimum or maximum limit I should know about?'
      ],
      [
        'subject' => 'Payment Schedule Clarification',
        'message' => 'Can you help me understand how my payment schedule is determined? I want to make sure I won’t miss any deadlines.'
      ],
      [
        'subject' => 'Update Contact Information',
        'message' => 'I’ve recently changed my email and phone number. How can I update my contact information in your records?'
      ],
      [
        'subject' => 'Account Registration Help',
        'message' => 'I’m having trouble signing up on your website. It shows an error after submitting the registration form. Please assist.'
      ],
      [
        'subject' => 'Loan Interest Rates',
        'message' => 'Could you send me a breakdown of your current loan interest rates and how they are applied to different loan types?'
      ],
      [
        'subject' => 'Co-maker Requirement',
        'message' => 'Do I need a co-maker to apply for a loan? If yes, what are the requirements and responsibilities of the co-maker?'
      ],
    ];

    $inquiry = $this->faker->randomElement($inquiries);

    return [
      'first_name' => $this->faker->firstName,
      'last_name'  => $this->faker->lastName,
      'email'      => $this->faker->unique()->safeEmail,
      'phone'      => $this->faker->phoneNumber,
      'inquiry'    => $inquiry['subject'],
      'message'    => $inquiry['message'],
    ];
  }
}
