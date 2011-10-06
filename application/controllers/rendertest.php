<?php

class Rendertest extends Controller {

    function __construct() {
	parent::Controller();
    }

    function index() {
	ui_render();
    }

}
?>
<dl>
    <tr>
	<td valign="top" style="width: 30%;"><span style="font-size: x-large;"><span style="text-decoration: underline;">Term</span></span></td>
	<td><span style="font-size: x-large;"><span style="text-decoration: underline;">Description</span></span></td>
    </tr>
    <tr>
	<dt>PWM</dt>
	<td>
	    Pulse-width modulation (PWM) is a method of regulating the output voltage of a power supply by varying the width(frequency), but not the height(amplitude), of a series of pulses. A Jaguar or Victor can interpret how much voltage to allow through to the attached electrical device (motor) based on a PWM signal. This allows the operator or programmer to control the speed of motors.
	</td>
    </tr>
    <tr>
	<dt>PID</dt>
	<td>Proportional-Integral-Derivative, (PID) a method of programming in which the programmer can ensure that a certain action happens. <a href="http://www.chiefdelphi.com/forums/showpost.php?p=897090&amp;postcount=5" target="_blank">More info...</a></td>
    </tr>
    <tr>
	<td>FRC</td>
	<td>First Robotics Competition</td>
    </tr>
    <tr>
	<td>Victor</td>
	<td>A Varible Speed Motor controller based on the PWM method. The only real difference between the Victor and Jaguar is the output relative to the PWM input. In the case of the Victor the Output Voltage(speed) is proportional to PWM input squared, thus a parabolic relationship.</td>
    </tr>
    <tr>
	<td>Jaguar</td>
	<td>A Varible Speed Motor controller based on the PWM method. The output of the Jaguar is directly proportional to that of the PWM input, forming a linear relationship.<br /></td>
    </tr>
    <tr>
	<td>Driver station / Classmate</td>
	<td>The 2009 blue driver station was replaced in 2010 with the Classmate. This small PC communicates with the robot to send and recieve signals. It can also be used to write code for the robot.<br /></td>
    </tr>
    <tr>
	<td>Router</td>
	<td>The Linksys wireless router will need to be connected to your driver station so it can communicate with the wireless bridge on the robot. <br /></td>
    </tr>
    <tr>
	<td>Bridge</td>
	<td>The Linksys Wireless Bridge is a small black box that allows for the robot to communicate with the driver station. </td>
    </tr>
    <tr>
	<td>Dongle</td>
	<td>On the driver station introduced in 2009, the dongle was a small grey switch that needed to be attached to the competition port in order to run the robot. It also provided the capability to enable and disable the robot.</td>
    </tr>
    <tr>
	<td>Crossover Cable</td>
	<td>A Crossover Cable is a special type of ethernet cable, that allows for direct communication between a computer and the cRio. </td>
    </tr>
    <tr>
	<td>cRio</td>
	<td>The Compact Reconfigurable Input Output (cRio) is produced by National Instruments; it is used on FIRST robots as the controller.</td>
    </tr>
    <tr>
	<td>Digital Side Car</td>
	<td>The Digital Side Car (DSC) is a circuit board capable of taking input from one of the cRio's modules.</td>
    </tr>
    <tr>
	<td>Breakout boards</td>
	<td>Some of the cRio's modules require breakout boards to interface with certain systems on the robot. Most of the breakout circuit boards require their own source of power through a wago connector. </td>
    </tr>
    <tr>
	<td>Power Distribution Board</td>
	<td>The power distribution board distributes power from the battery to the robot components. Some people with acute hearing notice a high-pitched humming coming from the board; this noise is from the circuits that convert the battery's energy to different voltages.</td>
    </tr>
    <tr>
	<td>Wago Connectors</td>
	<td>A plug the connects wires to many devices on the robot.<br /></td>
    </tr>
    <tr>
	<td>Gyro</td>
	<td>A sensor that reads angular direction based on an original position.<br /></td>
    </tr>
    <tr>
	<td>Accelerometer</td>
	<td>A sensor that reads change in the x and y positions and translates this information into distance travelled.<br /></td>
    </tr>
    <tr>
	<td>Gear Tooth Sensor</td>
	<td>A sensor that reads the number of teeth that has passed by and translates this information into distance travelled.<br /></td>
    </tr>
    <tr>
	<td>CIM Motor</td>
	<td>The CIM motor runs at 5400 rpm and the AndyMark Toughboxes are made to connect to them. <br /></td>
    </tr>
    <tr>
	<td>HID</td>
	<td>Anything that interfaces with a human is a Human Interface Device. This can be a joystick, game padel, etc.<br /></td>
    </tr>
    <tr>
	<td>Servo</td>
	<td>A small motor that can be moved at precise increments. Usually the Axis Camera base is moved using a servo motor.<br /></td>
    </tr>
    <tr>
	<td>Solenoid</td>
	<td>A pneumatic valve<br /></td>
    </tr>
    <tr>
	<td>Spike</td>
	<td>A relay<br /></td>
    </tr>
    <tr>
	<td>Relay</td>
	<td>A motor controller with only 3 states: either forward, backward, or off. <br /></td>
    </tr>
    <tr>
	<td>Nason Pressure Switch</td>
	<td> A pneumatic device that controls the pressure in the storage tanks.<br /></td>
    </tr>
</dl>
